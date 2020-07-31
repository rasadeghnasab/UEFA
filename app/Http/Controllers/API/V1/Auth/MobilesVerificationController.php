<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Events\MobileVerified;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetMobileRequest;
use App\Http\Requests\MobileValidationRequest;
use App\Models\MobileVerification;
use App\Models\User;
use Illuminate\Http\Response;

class MobilesVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);

        // prevent from throttle (this is done by middleware in __construct method)
        //        $this->middleware(['throttle:' . config('sms_verification.code_request_retry')])->only('sendVerificationCode');
    }

    public function sendVerificationCode(GetMobileRequest $request)
    {
        $mobile = $request->get('mobile');
        $response = [
            'message' => __('response.unsuccessfulSent'),
            'status' => Response::HTTP_FAILED_DEPENDENCY,
        ];

        $verification = MobileVerification::verificationCodeAlreadySent($mobile)->first();

        if (is_null($verification)) {
            $smsVerificationCode = codeGenerator()->smsVerification();

            $mobile = $request->get('mobile');

            $verification = new MobileVerification([
                'code' => $smsVerificationCode,
                'mobile' => $mobile,
            ]);
        }

        $message = __(
            config('sms_verification.message'),
            [
                'code' => $verification->code,
                'brand_name' => config('app.brand_name'),
                'front_end_url' => config('app.frontend'),
            ]
        );

        // send Code via sms to $request->mobile
        $sms = sms();
        $sms->send($mobile, $message);

        if ($sms->provider()->response()->isSent()) {
            // store code and mobile in database (mobiles_verification table)
            $verification->save();
            $response = [
                'message' => __('response.successfulSent'),
            ];
        }

        return response()->common($response);
    }

    public function validateMobile(MobileValidationRequest $request)
    {
        // verify sent code
        $verifiedSms = MobileVerification::mobileSmsVerify($request->get('mobile'), $request->get('code'))->first();

        if (is_null($verifiedSms)) {
            return response()->common([
                'message' => __('response.crud.fail.verify', ['model' => __('models.mobile')]),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ]);
        }

        // mark sent code as used one
        $verifiedSms->markAsUsed();

        // register and login user by mobile number
        $user = $this->registerOrFindUserByValidatedMobile($request);

        // trigger MobileVerified event
        event(new MobileVerified($user));

        // Get first listener response and sent it as token
        $response = $this->authorizedResponse($user->createToken('InstaPay Personal Access Client')->accessToken);

        return response()->common($response);
    }

    /**
     * Register and return a user
     *
     * @param MobileValidationRequest $request
     * @return User
     */
    private function registerOrFindUserByValidatedMobile(MobileValidationRequest $request): User
    {
        // create new user
        $user = User::firstOrCreate([
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
        ], [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'password' => bcrypt($request->get('password')),
        ]);

        return $user;
    }

    private function authorizedResponse($token)
    {
        return [
            'accessToken' => $token,
            'message' => __('response.crud.success.verify', ['model' => __('models.mobile')]),
        ];
    }
}

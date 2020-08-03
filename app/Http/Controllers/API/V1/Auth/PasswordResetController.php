<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use App\Models\MobileVerification;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetDo;
use App\Notifications\PasswordResetRequest;
use App\Http\Requests\PasswordResetCodeVerify;
use App\Http\Requests\PasswordResetCreateRequest;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        // prevent guests to change their password
        $this->middleware('guest:api')->except('reset');

        // allow logged in users to change their password
        $this->middleware('auth:api')->only('reset');

        // prevent from throttle (this is done by middleware in __construct method)
//        $this->middleware(['throttle:' . config('sms_verification.code_request_retry')])->only('create');
    }

    /**
     * Create token password reset
     *
     * @param PasswordResetCreateRequest $request
     * @return string message
     */
    public function create(PasswordResetCreateRequest $request)
    {
        $mobile = $request->get('mobile');
        $user = User::findByMobile($mobile)->first();
        $verification = MobileVerification::verificationCodeAlreadySent($mobile)->first();

        if (!$verification) {
            $code = codeGenerator()->smsVerification();

            $verification = new MobileVerification([
                'code' => $code,
                'mobile' => $mobile,
            ]);

            $verification->save();
        }

        $user->notify(new PasswordResetRequest($verification->code));

        return response()->common([
            'message' => __('response.successfulSent')
        ]);
    }

    /**
     * @param PasswordResetCodeVerify $request
     * @return mixed
     */
    public function verify(PasswordResetCodeVerify $request)
    {
        // create $mobile and $code variables
        $mobile = $request->get('mobile');
        $code = $request->get('code');

        $verification = MobileVerification::mobileSmsVerify($mobile, $code)->first();

        if (is_null($verification)) {
            return response()->common([
                'message' => __('response.crud.fail.verify', ['model' => __('models.mobile')]),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ]);
        }

        // mark sent code as used one
        $verification->markAsUsed();

        $user = User::findByMobile($mobile)->first();

        return response()->common([
            'data' => [
                'token' => $user->createToken('InstaPay Personal Access Client')->accessToken,
            ],
            'message' => __('response.crud.success.verify', ['model' => __('models.mobile')]),
        ]);
    }

    /**
     * @param PasswordResetDo $request
     * @return mixed
     */
    public function reset(PasswordResetDo $request)
    {
        // create $mobile and $code variables
        $password = $request->get('password');

        $request->user()->update(['password' => bcrypt($password)]);

        return response()->common([
            'message' => __('response.crud.success.update', ['model' => __('models.password')]),
        ]);
    }
}

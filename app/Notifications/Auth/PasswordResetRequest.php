<?php

namespace App\Notifications\Auth;

use App\Channels\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $code;

    /**
     * Create a new notification instance.
     *
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [Sms::class];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        return __(
            config('sms_verification.recover_password_message'),
            [
                'code' => $this->code,
                'brand_name' => config('app.brand_name'),
                'front_end_url' => config('app.frontend'),
            ]
        );
    }
}

<?php

namespace App\Listeners\PasswordReset;

use App\Events\PasswordReset;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshToken
{
    /**
     * Handle the event.
     *
     * @param PasswordReset $event
     * @return string
     */
    public function handle(PasswordReset $event): string
    {
        return $event->user->token();
    }
}

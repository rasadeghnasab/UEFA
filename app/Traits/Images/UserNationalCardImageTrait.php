<?php

namespace App\Traits\Images;

use App\Models\Images\UserNationalCardImage;

trait UserNationalCardImageTrait
{
    /**
     * Return model name in plural like shops, users
     *
     * @return string
     */
    public function imageableModel(): string
    {
        return 'usersNationalCard';
    }

    /**
     * Related image model
     *
     * @return string
     */
    public function imageModel(): string
    {
        return UserNationalCardImage::class;
    }
}

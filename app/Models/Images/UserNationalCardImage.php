<?php

namespace App\Models\Images;

class UserNationalCardImage extends Image
{
    protected $fillable = ['user_id', 'name', 'extension', 'title', 'alt'];

    /**
     * Determine base path to save origin uploaded images
     * @var string
     */
    protected $basePath = 'usersNationalCard/origin';
    protected $model = 'usersNationalCard';
}

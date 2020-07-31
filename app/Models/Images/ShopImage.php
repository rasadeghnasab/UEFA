<?php

namespace App\Models\Images;

class ShopImage extends Image
{
    protected $fillable = ['shop_id', 'name', 'extension', 'title', 'alt'];

    /**
     * Determine base path to save origin uploaded images
     * @var string
     */
    protected $basePath = 'shops/origin';
    protected $model = 'shops';
}

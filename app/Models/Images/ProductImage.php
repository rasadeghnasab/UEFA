<?php

namespace App\Models\Images;

class ProductImage extends Image
{
    protected $fillable = ['product_id', 'name', 'extension', 'title', 'alt'];

    /**
     * Determine base path to save origin uploaded images
     * @var string
     */
    protected $basePath = 'products/origin';
    protected $model = 'products';
}

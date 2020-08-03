<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Images\ShopImage;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use App\Models\Images\ProductImage;
use App\Models\Images\DefaultImage;
use App\Http\Controllers\Controller;
use App\Models\Images\UserNationalCardImage;

class MediasController extends Controller
{
    protected $models = [
        'shops' => ShopImage::class,
        'products' => ProductImage::class,
        'usersNationalCard' => UserNationalCardImage::class,
        'defaults' => DefaultImage::class,
    ];

    public function image($model, $name, $width = 150, $height = 150)
    {
        // check to see if this model is a valid model or not?
        $this->validModel($model);

        // instantiate the model
        $image = $this->modelInstantiation($model, $name);

        $image->image($width, $height);

        // return image on selected size
        return $image->image->response();
    }

    protected function validModel($model)
    {
        abort_if(
            !array_key_exists($model, $this->models),
            Response::HTTP_UNSUPPORTED_MEDIA_TYPE,
            __('Requested media type is not valid.')
        );
    }

    protected function modelInstantiation($model, $name)
    {
        $class = $this->modelToClass($model);

        $instance = $class::findByName($name);

        if ($instance instanceof Collection) {
            return $instance->first();
        }

        return $instance->firstOrFail();
    }

    protected function modelToClass($model)
    {
        return $this->models[$model];
    }
}

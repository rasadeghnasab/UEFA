<?php

namespace App\Traits;

use App\Models\Images\DefaultImage;

trait HasDefaultImageTrait
{
    // relationship with related image table
    public function images()
    {
        return $this->hasManyWithDefaultImage($this->imageModel());
    }

    // relationship with related image table
    public function image()
    {
        return $this->hasOneWithDefaultImage($this->imageModel());
    }

    public function hasOneWithDefaultImage($related, $foreignKey = null, $localKey = null)
    {
        return $this->hasOne($related, $foreignKey, $localKey)->withDefault(function () {
            return $this->instantiateDefaultImage();
        });
    }

    public function hasManyWithDefaultImage($related, $foreignKey = null, $localKey = null)
    {
        return $this->hasMany($related, $foreignKey, $localKey)->withDefault(function () {
            return $this->instantiateDefaultImage();
        });
    }

    private function instantiateDefaultImage()
    {
        $defaultImage = (new DefaultImage());
        $defaultImage->setName($this->imageableModel());

        return $defaultImage;
    }
}

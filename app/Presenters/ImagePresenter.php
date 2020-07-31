<?php

namespace App\Presenters;

use URL;

trait ImagePresenter
{
    public function getSizeAttribute()
    {
        return [
            'thumbnail' => $this->getThumbnailAttribute(),
            'medium' => $this->getMediumAttribute(),
            'large' => $this->getLargeAttribute(),
            'url' => $this->getUrlAttribute(),
        ];
    }

    public function getUrlAttribute(): string
    {
        return $this->urlBySize();
    }

    public function getThumbnailAttribute(): string
    {
        return $this->urlBySize('thumbnail');
    }

    public function getMediumAttribute(): string
    {
        return $this->urlBySize('medium');
    }

    public function getLargeAttribute(): string
    {
        return $this->urlBySize('large');
    }

    public function urlByDimensions($width, $height): string
    {
        $path = [
            $this->baseUrl,
            $this->model,
            $this->name,
            $width,
            $height
        ];

        return URL::to(implode('/', $path));
    }

    private function urlBySize($size = 'default'): string
    {
        $this->sizeToDimensions($size);

        return $this->urlByDimensions($this->width, $this->height);
    }

    private function sizeToDimensions($size): void
    {
        $size = config("image.sizes.{$size}");

        $dimensions = explode('*', $size);

        $this->setDimensions($dimensions[0], $dimensions[1]);
    }

    private function setDimensions($width, $height)
    {
        $width = (is_null($width) && is_null($height)) ? '150' : $width;

        $this->width = $width;
        $this->height = $height;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}

<?php

namespace App\Models\Interfaces;

interface HasDefaultImageInterface
{
    public function hasOneWithDefaultImage($related, $foreignKey = null, $localKey = null);

    public function hasManyWithDefaultImage($related, $foreignKey = null, $localKey = null);

    /**
     * Related image model
     *
     * @return string
     */
    public function imageableModel(): string;

    /**
     * Return related image model
     *
     * @return string
     */
    public function imageModel(): string;
}

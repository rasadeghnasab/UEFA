<?php

namespace App\Models\Interfaces;

interface ImageRepositoryInterface
{
    public function image($width, $height);

    public function save(array $options);

    public function delete();
}

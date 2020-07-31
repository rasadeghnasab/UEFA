<?php

namespace App\Models\Images;

use Illuminate\Support\Collection;

class DefaultImage extends Image
{
    protected $fillable = ['name'];
    protected $basePath = 'defaults/origin';
    protected $model = 'defaults';
    protected $attributes = [
        'extension' => 'png'
    ];

    /**
     * @param $query
     * @param $name
     * @return Collection
     */
    public function scopeFindByName($query, $name)
    {
        $item = new self(['name' => $name]);

        return Collection::make([$item]);
    }
}

<?php

namespace App\Models\Images;

use App\Presenters\ImagePresenter;
use App\Models\Repositories\ImageRepository;
use Illuminate\Http\UploadedFile;

abstract class Image extends ImageRepository
{
    use ImagePresenter;

    protected $hidden = [
        'created_at',
        'extension',
    ];

    protected $appends = [
        'size'
    ];

    protected $baseUrl = 'api/v1/media/images';
}

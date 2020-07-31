<?php

namespace App\Models\Repositories;

use File;
use Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Models\Interfaces\ImageRepositoryInterface;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    protected $path;
    protected $image;
    protected $width;
    protected $height;
    protected $uploadedImage;
    protected $basePath = 'images/origin';

    public function __construct(array $attributes = [], UploadedFile $file = null)
    {
        parent::__construct($attributes);
        $this->uploadedImage = $file;
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model(): string
    {
        return self::class;
    }

    public function getImageAttribute()
    {
        return Image::make($this->path);
    }

    /**
     * Retrieve image
     * @param int $width
     * @param int $height
     */
    public function image($width = 150, $height = 150)
    {
        $this->setDimensions($width, $height);
        $this->path();

        if (File::exists($this->path)) {
            $this->image = Image::make($this->path);
            return;
        }

        makeDirectoryOnFullPath($this->path);

        $this->resizeAndSave();
    }

    /**
     * @param UploadedFile $file
     */
    public function setImage(UploadedFile $file)
    {
        $this->uploadedImage = $file;
    }

    /**
     * Eloquent scope function to add filtering by name on query
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeFindByName($query, $name)
    {
        return $query->where('name', '=', $name);
    }

    /**
     * Save image record to the database and image file to host
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        // save image file
        $path = $this->uploadedImage->store($this->getImagePath());

        $this->name = getFileName($path);
        $this->extension = getFileExtension($path);

        // save image record to database
        return parent::save($options);
    }

    /**
     * Delete image record from database and image file from host
     */
    public function delete()
    {
        parent::delete();
        // delete image record from database

        Storage::delete($this->path);
        // remove image file from host
    }

    /**
     * Set path property to file path on host based on dimensions <br>
     * if one of dimensions is null set origin path to path property
     */
    public function path()
    {
        $this->path = $this->originPath();

        if (!is_null($this->width) && !is_null($this->height)) {
            $this->pathBySize();
        }
    }

    /**
     * Set image file path base on image width and height
     */
    protected function pathBySize()
    {
        $this->path = str_replace('origin', "{$this->width}-{$this->height}", $this->path);
    }

    /**
     * Return file original path
     * @return string
     */
    private function originPath()
    {
        $path = $this->getImagePath()
            . '/' . $this->getAttribute('name')
            . '.' . $this->getAttribute('extension');

        return Storage::path($path);
    }

    /**
     * Resize an original image and save result in a given path
     */
    private function resizeAndSave()
    {
        $this->image = Image::make($this->originPath());

        $this->image->resize($this->width, $this->height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $this->image->save($this->path, 60);
    }

    public function getImagePath()
    {
        return $this->basePath;
    }

    private function setDimensions($width, $height)
    {
        $width = (is_null($width) && is_null($height)) ? '150' : $width;

        $this->width = $width;
        $this->height = $height;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function setName($name)
    {
        $this->setAttribute('name', $name);
    }
}

<?php

namespace App\Models\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository extends Model
{
    /**
     * @var
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract protected function model(): string;

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }
}

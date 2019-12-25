<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class BaseObserver
{
    protected $model;
    private $collection;

    public function __construct()
    {
        $this->collection = $this->model::all();
    }

    public function refreshRedis($groupBy = 'id')
    {
        Cache::add($this->model, $this->filteredModel($groupBy), 1440);
    }

    public function filteredModel($column)
    {
        return $this->collection->groupBy($column)->toJson();
    }

    abstract protected function created(Model $model);
}

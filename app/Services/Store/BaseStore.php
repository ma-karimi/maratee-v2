<?php


namespace App\Services\Store;


abstract class BaseStore
{

    private $data = [];
    protected static $model = null;

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public static function store(array $data)
    {
        $service = new static();
        $service->data = $data;
        return static::$model::firstOrCreate($service->data());
    }

    protected abstract function data(): array;
}

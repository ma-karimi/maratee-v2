<?php


namespace App\Services\Store;


use App\Models\Location;
use League\Geotools\Coordinate\Coordinate;

abstract class BaseStore
{

    protected static $model = null;
    protected $data = [];

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public static function store(array $data)
    {
        $service = new static();
        $service->data = $data;
        $objModel = static::$model::where($service->whereData())->first();
        if ($objModel instanceof static::$model) {
            return $objModel;
        }
        return static::$model::create($service->data());
    }

    private function whereData(): array
    {
        $conditions = [];
        foreach ($this->data() as $key => $value)
            if (empty($value))
                continue;
            else if (is_array($value) && array_key_exists('en', $value))
                $conditions[] = ["{$key}->en", $value['en']];
            else
                $conditions[] = [$key, $value];
        return $conditions;
    }

    protected abstract function data(): array;

    protected function getModel(string $class, array $data)
    {
        $className = $this->getClassName($class);
        $objModel = $class::where('name->en', $this->$className['en'])->first();
        if ($objModel instanceof $class)
            return $objModel;
        return $class::Create($data);
    }

    protected function getClassName(string $class)
    {
        $parts = explode('/', $class);
        return end($parts);
    }
}

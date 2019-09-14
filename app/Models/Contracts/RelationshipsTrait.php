<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 8/6/19
 * Time: 11:33 AM
 */

namespace App\Models\Contracts;


use Exception;
use Illuminate\Database\Eloquent\Relations\Relation;
use ReflectionClass;
use ReflectionMethod;

trait RelationshipsTrait
{
    public static function relationshipsText($model)
    {
        return implode(',', array_keys(self::relationships($model)));
    }

    public static function relationships($model)
    {

        $model = new $model;

        $relationships = [];

        foreach ((new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                if ($method->name === 'deletePreservingMedia') continue;

                $return = $method->invoke($model);

                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName(),
                        'name' => $method->getName()
                    ];
                }
            } catch (Exception $e) {
                report($e);
            }
        }


        return $relationships;
    }

    public static function relationshipsWithType($model)
    {
        return collect(self::relationships($model))->mapToGroups(function ($item, $key) {
            return [$item['type'] => $item['name']];
        });
    }
}

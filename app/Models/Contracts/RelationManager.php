<?php


namespace App\Models\Contracts;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use ReflectionClass;
use ReflectionMethod;

trait RelationManager
{
    protected static $relationsList = [];

    protected static $relationsInitialized = false;

    protected static $relationClasses = [
        HasOne::class,
        HasMany::class,
        BelongsTo::class,
        BelongsToMany::class,
        MorphOne::class,
        MorphToMany::class
    ];

    public static function withAll(): Builder
    {
        $relations = Arr::flatten(static::getAllRelations());

        return $relations ? self::with($relations) : self::query();
    }

    public static function getAllRelations($type = null): array
    {
        if (!self::$relationsInitialized) {
            self::initAllRelations();
        }

        return $type ? (self::$relationsList[$type] ?? []) : self::$relationsList;
    }

    protected static function initAllRelations()
    {
        self::$relationsInitialized = true;

        $reflect = new ReflectionClass(static::class);

        foreach ($reflect->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            /** @var ReflectionMethod $method */
            if ($method->hasReturnType() && in_array((string)$method->getReturnType(), self::$relationClasses)) {
                self::$relationsList[(string)$method->getReturnType()][] = $method->getName();
            }
        }
    }

}

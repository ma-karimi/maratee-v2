<?php

namespace App\Repositories;

use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Make Model instance
     *
     * @return Model
     * @throws Exception
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Paginate records for scaffold.
     *
     * @param array $search
     * @param int $perPage
     * @param array|null $with_relations
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate($perPage, array $search = [], array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->paginate($perPage ?? 25, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();
        if (count($search)) {
            foreach ($search as $key => $value) {
                if (Arr::exists($this->getFieldsSearchable(), $key)) {
                    $scope = $this->getFieldsSearchable()[$key]['scope'];
                    $query->$scope($value);
                }
//                if (in_array($key, $this->getFieldsSearchable())) {
//                    $query->where($key, $value);
//                }
            }
        }

        if ($skip !== null) {
            $query->skip($skip);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @param array $with_relations
     * @return Builder[]|Collection
     */
    public function all($search = [], $skip = null, $limit = null, array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->get($columns);
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        try{
            DB::beginTransaction();
            $model = $this->model->newInstance($input);
            $model->save();
            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            report($e);
            abort(JsonResponse::HTTP_BAD_REQUEST,'Operation Failed!');
        }
        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $with_relations
     * @param array $columns
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find($id, array $with_relations = null, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @param int $id
     *
     * @return bool|mixed|null
     * @throws Exception
     *
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }

    /**
     * @return array
     */
    public function pluckName()
    {
        $plucks = $this->model->pluck('name', 'id')->toArray();
        $result = [];

        foreach ($plucks as $index => $pluck) {
            $result[$index] = $pluck['fa'];
        }

        return $result;
    }

}

<?php

namespace App\Repositories;

use App\Models\ActionHub;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


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
        if (count($this->getFieldsSearchable())) {
            $this->model->setNotSearchable($this->getFieldsSearchable());
        }
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
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Paginate records for scaffold.
     *
     * @param array $search
     * @param int $perPage
     * @param array|null $with_relations
     * @param array $columns
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function paginate($perPage, array $search = [], array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->latest()->paginate($perPage ?? 25, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return Builder
     * @throws Exception
     */
    public function allQuery($search = [])
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

        return $query->filtered([]);
    }

    /**
     * @param array $criteria
     * @param array $columns
     * @return Builder|Builder[]|Collection
     */
    public function getByCriteria(array $criteria, $columns = ['*'])
    {
        $query = $this->model->newQuery();
        foreach ($criteria as $index => $criterion) {
            if ($criterion != null)
                $query = $query->where($index, $criterion);
        }
        return $query->get($columns);
    }

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
     * @throws Exception
     */
    public function all($search = [], $skip = null, $limit = null, array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })->latest()->get($columns);
    }

    /**
     * Create model record
     *
     * @param $input
     * @return Model
     * @throws ValidationException
     */
    public function create($input)
    {
        if (App::environment() == 'production') {
            try {
                DB::beginTransaction();
                $model = $this->model->newInstance($input);
                $model->save();
                DB::commit();
                return $model;
            } catch (Exception $e) {
                DB::rollBack();
                report($e);
                throw ValidationException::withMessages(['errors' => ['message' => 'Operation Failed!', 'Exception' => $e]]);
            }
        } else {
            $model = $this->model->newInstance($input);
            $model->save();
            return $model;
        }

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
     * @throws ValidationException
     */
    public function update($input, $id)
    {
        if (App::environment() == 'production') {
            try {
                DB::beginTransaction();
                $query = $this->model->newQuery();

                $model = $query->findOrFail($id);

                $model->fill($input);

                $model->save();
                DB::commit();
                return $model;
            } catch (Exception $e) {
                DB::rollBack();
                report($e);
                throw ValidationException::withMessages(['errors' => ['message' => 'Operation Failed!', 'Exception' => $e]]);
            }
        } else {
            $query = $this->model->newQuery();

            $model = $query->findOrFail($id);
            $model->fill($input);

            Log::info($input);
            $model->save();
            return $model;
        }
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


    public function createHub($class_id, $related_model, array $ids, array $additional_data = null)
    {
        $record = $this->findException($class_id);
        [$related_model_table, $related_model_class, $related_key, $foreign_key] = $this->getRelatedModelAndClass($related_model, $record);

        $assigned_id = $record->$related_model->pluck('id')->toArray();

        $different_ids = array_diff($ids, $assigned_id);
        $different_assigned = array_diff($assigned_id, $ids);
        //attach and update pivot fields
        $this->attachAndUpdateFields($related_model, $ids, $additional_data, $related_model_class, $related_key, $record, $different_ids);
        $related_model_class::where($foreign_key, $class_id)->whereIn($related_key, $different_assigned)->delete();

        return $record->$related_model()->get();
    }

    /**
     * @param $class_id
     * @return mixed
     */
    protected function findException($class_id)
    {
        $record = $this->model->find($class_id);
        abort_if(empty($record), JsonResponse::HTTP_NOT_FOUND, 'record not found');
        return $record;
    }

    /**
     * @param $related_model
     * @param $record
     * @return array
     */
    protected function getRelatedModelAndClass($related_model, $record): array
    {
        $related_model_table = $record->$related_model()->getTable();
        $related_model_class = resolve('App\\Models\\' . Str::studly(Str::singular($related_model_table)));
        $related_key = $record->$related_model()->getRelatedPivotKeyName();
        $foreign_key = $record->$related_model()->getForeignPivotKeyName();

        return [$related_model_table, $related_model_class, $related_key, $foreign_key];
    }

    /**
     * @param $related_model
     * @param array $ids
     * @param array $additional_data
     * @param $related_model_class
     * @param $related_key
     * @param $record
     * @param array $different_ids
     */
    protected function attachAndUpdateFields($related_model, array $ids, $additional_data, $related_model_class, $related_key, $record, array $different_ids): void
    {
        if (!empty($additional_data)) {
            //update pivot fields
            $exists_related_ids = $related_model_class::whereIn($related_key, $ids)->pluck('id')->toArray();
            if (count($exists_related_ids)) {
                $this->setJsonCast($additional_data, $related_model_class);
                $related_model_class::whereIn('id', $exists_related_ids)->update($additional_data);
            }
            if (count($different_ids) && !empty($different_ids[0])) {
                Log::info([$different_ids, $additional_data]);
                $record->$related_model()->attach($different_ids, $additional_data);
            }
        } //attach only ids
        else {
            if (count($different_ids) && !empty($different_ids[0])) {
                $record->$related_model()->attach($different_ids);
            }
        }
    }

    /**
     * @param array $additional_data
     * @param $related_model_class
     */
    protected function setJsonCast(array &$additional_data, $related_model_class): void
    {
        foreach ($additional_data as $index => $additional_datum) {
            if (isset($related_model_class->getCasts()[$index]) and $related_model_class->getCasts()[$index] = 'json') {
                $additional_data[$index] = json_encode($additional_datum);
            }
        }
    }

    public function deleteHub($class_id, $related_model, array $ids)
    {
        $record = $this->findException($class_id);
        [$related_model_table, $related_model_class, $related_key, $foreign_key] = $this->getRelatedModelAndClass($related_model, $record);
        $hub_collection = DB::table($related_model_table)->whereIn($related_key, $ids)
            ->where($foreign_key, $class_id)->get();
        return $related_model_class::whereIn('id', $hub_collection->pluck('id'))->delete();
    }

    public function getConstants($class)
    {
        $model_class = resolve('App\\Models\\' . Str::studly(Str::singular($class)));
        return $model_class::getConstants();
    }

    public function storeAction($id, $input, int $action_type)
    {

        $action = ActionHub::updateOrCreate([
            'action_id' => $action_type,
            'actionable_type' => $this->model(),
            'actionable_id' => $id,
        ], [
            'project_id' => $input['project_id'] ?? null,
            'department_id' => $input['department_id'] ?? null,
            'date' => $input['date'] ?? null,
            'description' => $input['description'] ?? null
        ]);
        //store actors
        $action_repo = resolve('App\\Repositories\\ActionHubRepository');
        $action_repo->createHub($action->id, 'actors', $input['actors']);
        return ActionHub::with('actors')->whereHas('actors')->get();
    }
}

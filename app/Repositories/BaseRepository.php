<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
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
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();


    private function getKeys()
    {

        $keys = DB::table('keys')->where('model', '=', '\\' . $this->model->getMorphClass())->get();

        return $keys;
    }

    /**
     * Make Model instance
     *
     * @return Model
     * @throws \Exception
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        $collection = $query->get($columns);

        if (!empty($collection)) {
            foreach ($collection as &$item) {
                $properties = DB::table('properties')
                    ->join('keys', 'keys.id', '=', 'properties.key_id')
                    ->select('keys.label', 'keys.type', 'properties.value')
                    ->where('properties.model_id', '=', $item->id)
                    ->where('keys.model', '=', '\\' . $this->model->getMorphClass())
                    ->get();

                $item->properties = $properties;
            }
        }

        return $collection;
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
        $model = $this->model->newInstance($input);

        $model->save();

        $keys = $this->getKeys();

        foreach ($keys as $key) {
            $id = 'property_' . $key->id;
            if (isset($input[$id])) {
                DB::table('properties')->insert(
                    array(
                        'key_id' => $key->id,
                        'model_id' => $model->id,
                        'value' => $input[$id],
                        'created_at' => Carbon::now()
                    )
                );
            }
        }

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        $model = $query->find($id, $columns);

        if (!empty($model)) {

            $properties = DB::table('properties')
                ->join('keys', 'keys.id', '=', 'properties.key_id')
                ->select('keys.id', 'keys.label', 'keys.type', 'properties.value')
                ->where('properties.model_id', '=', $id)
                ->where('keys.model', '=', '\\' . $this->model->getMorphClass())
                ->get();
            foreach ($properties as $property) {
                $model->{'property_' . $property->id} = $property->value;
            }
            $model->properties = $properties;
        }

        return $model;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        $keys = $this->getKeys();

        foreach ($keys as $key) {
            DB::table('properties')
                ->where('key_id', '=', $key->id)
                ->where('model_id', '=', $id)
                ->delete();
        }

        foreach ($keys as $key) {
            $id = 'property_' . $key->id;
            if (isset($input[$id])) {
                DB::table('properties')->insert(
                    array(
                        'key_id' => $key->id,
                        'model_id' => $model->id,
                        'value' => $input[$id],
                        'created_at' => Carbon::now()
                    )
                );
            }
        }

        return $model;
    }

    /**
     * @param int $id
     *
     * @return bool|mixed|null
     * @throws \Exception
     *
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $keys = $this->getKeys();

        foreach ($keys as $key) {
            DB::table('properties')
                ->where('key_id', '=', $key->id)
                ->where('model_id', '=', $id)
                ->delete();
        }

        return $model->delete();
    }
}

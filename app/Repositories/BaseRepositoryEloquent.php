<?php

namespace App\Repositories;

abstract class BaseRepositoryEloquent implements RepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $attributes=[])
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function update($id, array $attributes)
    {
        $item = $this->findById($id);
        $item->update($attributes);

        return $item;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }

    /**
     * @param $id
     * @param array $relations
     * @return void
     */
    public function setRelations($id, array $relations)
    {
        $item = $this->findById($id);
        $modelRelations = $this->model->getRelations();

        foreach ($relations as $relation) {

            if (!isset($relation['name']) && !isset($relation['model'])) {
                continue;
            }

            $name = $relation['name'];
            $model = $relation['model'];

            if (!isset($name, $modelRelations)) {
                continue;
            }

            $relationModel = $modelRelations[$name];

            if (!$model instanceof $relationModel) {
                continue;
            }

            $item->$name()->associate($model);
            $item->save();
        }
    }
}

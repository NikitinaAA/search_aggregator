<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes=[]);

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);
}

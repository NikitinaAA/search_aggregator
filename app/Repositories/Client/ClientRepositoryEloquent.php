<?php

namespace App\Repositories\Client;

use App\Repositories\BaseRepositoryEloquent;
use App\Client;

class ClientRepositoryEloquent extends BaseRepositoryEloquent implements ClientRepositoryInterface
{
    /**
     * @var Client
     */
    protected $model;

    /**
     * ClientRepositoryEloquent constructor.
     * @param Client $model
     */
    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $token
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function findByToken(string $token)
    {
        return $this->model->where('token', $token)->firstOrFail();
    }
}

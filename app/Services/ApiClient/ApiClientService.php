<?php

namespace App\Services\ApiClient;

use App\Service;
use App\Services\SocketClient\SocketClientInterface;

abstract class ApiClientService
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $socketClient;

    /**
     * @var string
     */
    protected static $command;

    /**
     * ApiClientService constructor.
     */
    public function __construct()
    {
        $this->socketClient = app(SocketClientInterface::class);
    }

    /**
     * @return mixed
     */
    abstract public function getResult();

    /**
     * @return string
     */
    public function getCommand()
    {
        return static::$command;
    }

    /**
     * @param Service $service
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    protected function callApi(Service $service, $data)
    {
        $this->socketClient->initConnection(['ip' => $service->ip, 'port' => $service->port]);

        $this->socketClient->setRequestData($data);

        $response = $this->socketClient->getResponseData();

        if (!$response) {
            return false;
        }

        if (!$response['success']) {
            throw new \ErrorException($response['error']);
        }

        return $response;
    }

    /**
     * @return array
     */
    protected function buildRequestData()
    {
        $data['command'] = $this->getCommand();

        return $data;
    }
}

<?php

namespace App\Services\SocketClient;

interface SocketClientInterface
{
    /**
     * @param $address
     * @return mixed
     */
    public function initConnection($address);

    /**
     * @param array $data
     * @return mixed
     */
    public function setRequestData(array $data);

    /**
     * @return mixed
     */
    public function getResponseData();
}

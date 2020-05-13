<?php

namespace App\Services\ApiClient\Commands;

use App\Facades\ServiceRepository;
use App\Services\ApiClient\ApiClientService;

class SearchParamsService extends ApiClientService
{
    /**
     * @var string
     */
    protected static $command = 'get_search_params';

    /**
     * @return array
     * @throws \Exception
     */
    public function getResult()
    {
        $data = $this->buildRequestData();

        $services = ServiceRepository::getActiveItems();

        $params = [];

        foreach ($services as $service) {

            $response = $this->callApi($service, $data);

            if (!isset($response['params'])) {
                continue;
            }

            $params = array_unique(array_merge($params, $response['params']));
        }

        $result['params'] = $params;

        return $result;
    }
}

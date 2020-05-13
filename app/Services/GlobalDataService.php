<?php

namespace App\Services;

use App\Client;
use App\Facades\ClientRepository;
use App\Services\Models\SearchRequestService;
use App\Services\ApiClient\Commands\SearchParamsService;
use App\Services\ApiClient\Commands\SearchService;

class GlobalDataService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $params;

    /**
     * GlobalDataService constructor.
     * @param string $token
     * @param array $params
     */
    public function __construct(string $token, array $params)
    {
        $this->client = $this->getClient($token);
        $this->params = $params;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTypes()
    {
        $searchableTypesService = new SearchParamsService();
        $result = $searchableTypesService->getResult();

        return $result;
    }

    /**
     * @return array|mixed
     * @throws \Exception
     */
    public function search()
    {
        $searchRequest = $this->getSearchRequest();
        $searchService = new SearchService($searchRequest, $this->params);

        $result = $searchService->getResult();

        $requestStatus = !empty($result);
        SearchRequestService::updateStatus($searchRequest, $requestStatus);

        return $result;
    }

    /**
     * @param $token
     * @return mixed
     */
    private function getClient($token)
    {
        return ClientRepository::findByToken($token);
    }

    /**
     * @return mixed
     */
    private function getSearchRequest()
    {
        return SearchRequestService::create($this->client);
    }
}

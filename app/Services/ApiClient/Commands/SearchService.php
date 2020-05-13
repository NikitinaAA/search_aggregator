<?php

namespace App\Services\ApiClient\Commands;

use App\Facades\ServiceRepository;
use App\SearchRequest;
use App\Services\ApiClient\ApiClientService;

class SearchService extends ApiClientService
{
    /**
     * @var SearchRequest
     */
    private $request;

    /**
     * @var array
     */
    private $params;

    /**
     * @var int
     */
    public static $maxIterationsCount = 2;

    /**
     * @var string
     */
    protected static $command = 'search';

    /**
     * SearchService constructor.
     * @param SearchRequest $request
     * @param array $params
     */
    public function __construct(SearchRequest $request, array $params)
    {
        parent::__construct();

        $this->request = $request;
        $this->params = $params;
    }

    /**
     * @return array|mixed
     * @throws \Exception
     */
    public function getResult()
    {
        $data = $this->buildRequestData();

        $simpleResult = $this->simpleSearch($data);

        if (!$simpleResult) {
            return false;
        }

        if (!isset($this->params['isdn']) && !$this->checkResponseParams($simpleResult)) {
            return $simpleResult;
        }

        $advancedResult = $this->advancedSearch($data);

        return array_merge($simpleResult, $advancedResult);
    }

    /**
     * @return array
     */
    protected function buildRequestData()
    {
        $params = $this->params;

        $data = [
            'request_id' => $this->request->id,
            'iterative_search' => false,
            'max_iterations_count' => self::$maxIterationsCount
        ];

        if (!empty($params['iterative_search'])) {
            $data['iterative_search'] = true;
            unset($params['iterative_search']);
        }

        $data['params'] = $params;

        return array_merge(parent::buildRequestData(), $data);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    private function simpleSearch(array $data)
    {
        $service = ServiceRepository::getMainItem();

        $response = $this->callApi($service, $data);

        if (!isset($response['results'])) {
            return false;
        }

        return $response['results'];
    }

    /**
     * @param array $data
     * @return array
     * @throws \Exception
     */
    private function advancedSearch(array $data)
    {
        $result = [];

        $services = ServiceRepository::getSecondaryItems();

        foreach ($services as $service) {

            $response = $this->callApi($service, $data);

            if (!isset($response['results'])) {
                continue;
            }

            $result = array_merge($result, $response['results']);
        }

        return $result;
    }

    /**
     * @param array $data
     * @return bool
     */
    private function checkResponseParams(array $data)
    {
        $params = [];

        foreach ($data as $sourceName => $item) {
            $params = array_merge($params, array_column($item['direct_search'], 'param_name'));
        }

        if (in_array('isdn', $params)) {
            return true;
        }

        return false;
    }
}

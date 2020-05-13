<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GlobalDataService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var GlobalDataService
     */
    private $dataService;

    /**
     * SearchController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $token = $request->route('token');
        $params = $request->all();

        $this->dataService = new GlobalDataService($token, $params);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTypes()
    {
        $result = $this->dataService->getTypes();

        return $result;
    }

    /**
     * @return array|mixed
     * @throws \Exception
     */
    public function search()
    {
        $result = $this->dataService->search();

        return $result;
    }
}

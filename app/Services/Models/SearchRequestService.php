<?php

namespace App\Services\Models;

use App\Client;
use App\SearchRequest;
use App\Facades\SearchRequestRepository;

class SearchRequestService
{
    /**
     * @param Client $client
     * @param array $attributes
     * @return mixed
     */
    public static function create(Client $client, array $attributes=[])
    {
        $searchRequest = SearchRequestRepository::create($attributes);

        $relations = [
            ['name' => 'client', 'model' => $client]
        ];

        SearchRequestRepository::setRelations($searchRequest->id, $relations);

        return $searchRequest;
    }

    /**
     * @param SearchRequest $request
     * @param bool $status
     * @return void
     */
    public static function updateStatus(SearchRequest $request, bool $status)
    {
        SearchRequestRepository::update($request->id, ['is_success' => $status]);
    }
}

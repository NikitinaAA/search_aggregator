<?php

namespace App\Observers;

use App\SearchRequest;
use App\Services\Models\ClientService;

class SearchRequestObserver
{
    /**
     * @param SearchRequest $searchRequest
     */
    public function updated(SearchRequest $searchRequest)
    {
        if ($searchRequest->is_success) {
            ClientService::reduceAvailableRequestsNumber($searchRequest->client);
        }
    }
}

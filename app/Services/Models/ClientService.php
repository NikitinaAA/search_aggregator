<?php

 namespace App\Services\Models;

 use App\Client;
 use App\Facades\ClientRepository;

 class ClientService
 {
     /**
      * @param Client $client
      * @return mixed
      */
     public static function reduceAvailableRequestsNumber(Client $client)
     {
         $availableNumber = $client->available_requests_number;
         $availableNumber--;

         $client = ClientRepository::update($client->id, ['available_requests_number' => $availableNumber]);

         return $client;
     }
 }

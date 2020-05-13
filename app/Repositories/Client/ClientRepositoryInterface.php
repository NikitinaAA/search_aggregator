<?php

 namespace App\Repositories\Client;

 use App\Repositories\RepositoryInterface;

 interface ClientRepositoryInterface extends RepositoryInterface
 {
     /**
      * @param string $token
      * @return mixed
      */
     public function findByToken(string $token);
 }

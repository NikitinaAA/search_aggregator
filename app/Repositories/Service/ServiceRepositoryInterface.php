<?php

namespace App\Repositories\Service;

use App\Repositories\RepositoryInterface;

interface ServiceRepositoryInterface extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getMainItem();

    /**
     * @return mixed
     */
    public function getSecondaryItems();

    /**
     * @return mixed
     */
    public function getActiveItems();
}

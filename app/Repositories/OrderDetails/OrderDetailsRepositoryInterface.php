<?php

namespace App\Repositories\OrderDetails;
use App\Repositories\RepositoryInterface;
interface OrderDetailsRepositoryInterface extends RepositoryInterface
{
    public function getAll();
}

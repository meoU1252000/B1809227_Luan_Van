<?php

namespace App\Repositories\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Order::class;
    }
}

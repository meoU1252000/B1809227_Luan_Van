<?php

namespace App\Repositories\OrderDetails;
use App\Repositories\BaseRepository;

class OrderDetailsRepository extends BaseRepository implements OrderDetailsRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\OrderDetail::class;
    }
}

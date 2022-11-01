<?php

namespace App\Repositories\Address;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Customer_Address::class;
    }
}

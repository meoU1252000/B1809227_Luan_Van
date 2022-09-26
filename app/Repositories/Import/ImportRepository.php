<?php

namespace App\Repositories\Import;

use App\Models\Staff;
use App\Models\Supplier;

use App\Repositories\BaseRepository;
class ImportRepository extends BaseRepository implements ImportRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Import::class;
    }

    public function getSupplier(){
        return Supplier::all();
    }

    public function getStaff(){
        return Staff::all();
    }
}

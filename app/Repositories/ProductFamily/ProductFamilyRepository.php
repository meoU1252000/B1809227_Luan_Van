<?php

namespace App\Repositories\ProductFamily;
use App\Repositories\BaseRepository;

class ProductFamilyRepository extends BaseRepository implements ProductFamilyRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductFamily::class;
    }
}

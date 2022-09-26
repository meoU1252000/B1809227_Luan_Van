<?php

namespace App\Repositories\Brand;
use App\Repositories\BaseRepository;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Brand::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

}

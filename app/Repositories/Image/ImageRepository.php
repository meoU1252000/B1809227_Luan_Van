<?php

namespace App\Repositories\Image;
use App\Repositories\BaseRepository;
use App\Models\Product;
class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Image::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getProduct($id){
        return Product::find($id);
    }
}

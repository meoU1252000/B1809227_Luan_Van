<?php

namespace App\Repositories\ProductPrice;

use App\Models\Import;
use App\Models\Product;
use App\Repositories\BaseRepository;
class ProductPriceRepository extends BaseRepository implements ProductPriceRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductPrice::class;
    }

    public function getProductAll(){
        return Product::all();
    }

    public function getImportAll(){
        return Import::all();
    }

    public function getProducts($id){
        $products = Import::find($id)->get()->get_products;
        return $products;
    }

    public function getImport($id){
        return Import::find($id);
    }

    public function getProduct($id){
        return Product::find($id);
    }
}

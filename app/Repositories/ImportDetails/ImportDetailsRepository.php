<?php

namespace App\Repositories\ImportDetails;

use App\Models\Import;
use App\Models\Product;
use App\Repositories\BaseRepository;
class ImportDetailsRepository extends BaseRepository implements ImportDetailsRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ImportDetail::class;
    }

    public function getImport($id){
        return Import::find($id);
    }

    public function getProduct(){
        return Product::all();
    }

    public function addImportDetails($attributes = []){
        $arr = array();
        // foreach($attributes['product_id'] as $attribute) {
        //     $arr['attribute_name'] = $attribute;
        //     $arr['category_id'] = $attributes['category_id'];
        //     $cateAttribute = $this->create($arr);
        // }
        for($i = 0; $i < count($attributes['product_id']); $i++){
            $arr['import_id'] = $attributes['import_id'];
            $arr['product_id'] = $attributes['product_id'][$i];
            $arr['import_price'] =  $attributes['import_price'][$i];
            $arr['import_product_quantity'] = $attributes['import_product_quantity'][$i];
            $import_detail = $this->create($arr);
        }
        return true;
    }
}

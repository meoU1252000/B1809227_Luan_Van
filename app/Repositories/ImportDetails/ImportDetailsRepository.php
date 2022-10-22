<?php

namespace App\Repositories\ImportDetails;

use App\Models\Import;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;
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

    public function getProductExceptInMonth(){
        $now = Carbon::now();
        $import_details = $this->model->whereYear('created_at','=',$now->year)->whereMonth('created_at','=',$now->month)->get();
        // dd($import_details);
        $array_product_id = array();
        if($import_details->isNotEmpty()){
            foreach($import_details as $import_detail){
                array_push($array_product_id,$import_detail->get_product($import_detail->product_id)->id);
            } 
            return Product::whereNotIn('id', $array_product_id)->get();
        }else{
            return Product::all();
        }
    }

    public function addImportDetails($attributes = []){
        $arr = array();
        // dd($attributes['product_id'][1]);
        for($i = 0; $i < count($attributes['product_id']); $i++){
            $arr['import_id'] = $attributes['import_id'];
            $arr['product_id'] = $attributes['product_id'][$i];
            $arr['import_price'] =  $attributes['import_price'][$i];
            $arr['import_product_quantity'] = $attributes['import_product_quantity'][$i];
            $product = Product::find($arr['product_id']);
            $product_quantity_new = ($product->product_quantity_stock) + (int)$arr['import_product_quantity'];
            $update_product_quantity = Product::where('id', $arr['product_id'])->update([
                'product_quantity_stock' => $product_quantity_new
            ]);
            $import_detail = $this->model->create($arr);
        }
        return true;
    }
}

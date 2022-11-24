<?php

namespace App\Repositories\Import;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use App\Models\ImportDetail;
use App\Repositories\BaseRepository;
use App\Models\Product;
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
        return User::all();
    }

    public function getProductExceptInMonth(){
        $now = Carbon::now();
        $import_details = ImportDetail::whereYear('created_at','=',$now->year)->whereMonth('created_at','=',$now->month)->get();
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
}

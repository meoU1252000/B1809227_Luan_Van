<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;
    protected $table = 'import_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'import_id',
        'product_id',
        'import_price',
        'import_product_quantity',
        'import_price_sell',
        'import_product_stock',
    ];

    public function get_import(){
        return $this->belongsTo(Import::class,'import_id','id');
    }

    public function get_products(){
        return $this->belongsToMany(Product::class,'product_id','id');
    }

    public function get_product($id){
        return Product::find($id);
    }
}

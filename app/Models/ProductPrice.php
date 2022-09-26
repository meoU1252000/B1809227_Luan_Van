<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    protected $table = 'product_price';
    protected $primaryKey = 'id';
    protected $fillable = [
        'import_id',
        'product_id',
        'product_price',
        'date_start',
        'date_end'
    ];

    public function get_product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function get_import(){
        return $this->belongsTo(Import::class,'import_id','id');
    }
}

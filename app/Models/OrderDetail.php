<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_price',
        'product_number',
    ];

    public function get_product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}

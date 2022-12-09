<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;
    protected $table = 'product_rating';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'customer_id',
        'order_id',
        'star_rating_number',
        'rating_comment'
    ];

    public function get_customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function get_product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

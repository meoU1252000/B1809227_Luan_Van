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
    ];
}

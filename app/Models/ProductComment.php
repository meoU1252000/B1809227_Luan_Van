<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;
    protected $table = 'product_comment';
    protected $primaryKey = 'id';
    protected $fillable = [
        'comment_parent',
        'product_id',
        'customer_id',
        'comment_content'
    ];
}

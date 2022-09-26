<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFamily extends Model
{
    use HasFactory;
    protected $table = 'product_family';
    protected $primaryKey = 'id';
    protected $fillable = [
        'family_name',
    ];
}

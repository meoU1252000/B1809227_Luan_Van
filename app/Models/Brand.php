<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $primaryKey = 'id';
    protected $fillable = [
        'brand_name',
        'brand_description',
        'brand_status'
    ];
}

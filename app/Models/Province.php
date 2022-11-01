<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    protected $fillable = [
        'administrative_unit_id',
        'administrative_region_id',
        'name',
        'name_en',
        'full_name',
        'full_name_en',
        'code_name'
    ];
}

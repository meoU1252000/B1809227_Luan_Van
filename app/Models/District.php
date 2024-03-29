<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'province_code',
        'administrative_unit_id',
        'name',
        'name_en',
        'full_name',
        'full_name_en',
        'code_name'
    ];
}

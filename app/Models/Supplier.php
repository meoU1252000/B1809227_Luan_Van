<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'supplier_email',
        'supplier_phone',
        'supplier_status',
        'supplier_note'
    ];
}

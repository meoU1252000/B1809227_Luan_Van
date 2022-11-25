<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Address extends Model
{
    use HasFactory;
    protected $table = 'customer_address';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'ward_id',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Address extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'receive_name',
        'receiver_address',
        'receive_phone'
    ];

}

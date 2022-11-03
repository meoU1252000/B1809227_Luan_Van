<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = [
        'address_id',
        'staff_id',
        'event_id',
        'receive_date',
        'order_status',
        'total_price'
    ];
}

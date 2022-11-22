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
        'code_id',
        'receive_date',
        'order_status',
        'total_price',
        'payment',
        'note'
    ];

    public function get_address(){
        return $this->belongsTo(Customer_Address::class,'address_id','id');
    }

    public function get_order_detail(){
        return $this->hasMany(Order_Detail::class,'order_id','id');
    }
}

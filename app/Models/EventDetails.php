<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
    use HasFactory;
    protected $table = 'event_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'event_id',
        'code_name',
        'discount_value',
        'discount_unit',
        'event_start',
        'event_end'
    ];
}

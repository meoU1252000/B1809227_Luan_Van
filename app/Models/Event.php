<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $fillable = [
        'event_name',
        'event_description',
        'event_start',
        'event_end'
    ];

    public function get_details(){
        return $this->hasMany(EventDetails::class,'event_id','id');
    }
}

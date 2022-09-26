<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeParams extends Model
{
    use HasFactory;
    protected $table = 'attribute_param';
    protected $fillable = [
        'attribute_id',
        'product_id',
        'param_value',
    ];

    public function get_attribute(){
        return $this->belongsToMany(CategoryAttribute::class,'attribute_param','attribute_id','product_id');
    }
}

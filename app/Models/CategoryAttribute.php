<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    use HasFactory;
    protected $table = 'category_attributes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'attribute_name',
    ];

    public function get_category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function get_param($attribute_id,$product_id){
        return AttributeParams::where('attribute_id',$attribute_id)->where('product_id',$product_id)->first();
    }
   
    public function get_product(){
        return $this->belongsToMany(CategoryAttribute::class,'attribute_param','attribute_id','product_id');
    }

}

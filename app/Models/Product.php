<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'brand_id',
        'product_family_id',
        'product_name',
        'product_description',
        'main_image_src',
        'product_price',
        'product_status'
    ];

    public function get_brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function get_family(){
        return $this->belongsTo(ProductFamily::class,'product_family_id','id');
    }

    public function get_category(){
        return $this->belongsToMany(CategoryAttribute::class,'attribute_param','product_id','attribute_id')->first()->belongsTo(Category::class,'category_id','id');
    }
    

    public function get_attribute(){
        return $this->belongsToMany(CategoryAttribute::class,'attribute_param','product_id','attribute_id');
    }

    public function get_import(){
        return $this->belongsToMany(Import::class,'import_details','product_id','import_id');
    }
}

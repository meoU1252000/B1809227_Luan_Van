<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_parent',
        'category_name',
        'category_description',
        'category_status'
    ];

    public function get_parent(){
        return $this->belongsTo(Self::class,'category_parent','id');
    }

    public function get_attribute(){
        return $this->hasMany(CategoryAttribute::class,'category_id','id');
    }

    public function childrenCategories() {
        if(with('childrenCategories')){
            return $this->hasMany(Self::class,'category_parent','id')->with('childrenCategories');
        }
    }

    public function children() {
        if(with('children')){
            return $this->hasMany(Self::class,'category_parent','id')->with('children');
        }
    }

    public function products() {
       return $this->hasMany(Product::class,'category_id','id');

    }
}

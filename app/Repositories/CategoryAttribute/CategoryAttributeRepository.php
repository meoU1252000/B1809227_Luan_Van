<?php

namespace App\Repositories\CategoryAttribute;
use App\Repositories\BaseRepository;
use App\Models\Category;
use App\Models\CategoryAttribute;

class CategoryAttributeRepository extends BaseRepository implements CategoryAttributeRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\CategoryAttribute::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getCategory(){
        return Category::all();
    }

    public function getCategoryById($id){
        return Category::find($id);
    }

    public function addAttributes($attributes = []){
        $arr = array();
        foreach($attributes['attribute_name'] as $attribute) {
            $arr['attribute_name'] = $attribute;
            $arr['category_id'] = $attributes['category_id'];
            $cateAttribute = $this->create($arr);
        }
        return true;
    }

    public function updateAttributes($attributes){
        for($i=0 ; $i<count($attributes['attribute_name']);$i++){
            $categories = CategoryAttribute::find($attributes['attribute_id'][$i])->update([
               'attribute_name' => $attributes['attribute_name'][$i],
            ]);
        }
    }

    public function deleteAttributes($id){
        return CategoryAttribute::where('category_id', $id)->delete();
    }

    

}

<?php

namespace App\Repositories\Category;
use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    // public function treeCategory(){
    //     $categories = Category::where('category_parent', 0)->with('childrenCategories')->get();
    //     return $categories;
    // }

}

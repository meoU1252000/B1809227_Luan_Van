<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\AttributeParams;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\ProductFamily;
use App\Models\ProductPrice;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProducts()
    {
        return $this->model->select('product_name')->take(5)->get();
    }

    public function getBrandAll()
    {
        return Brand::all();
    }

    public function getFamilyAll(){
        return ProductFamily::all();
    }

    public function getBrandExceptId($id)
    {
        return Brand::where('id', '!=', $id)->get();
    }

    public function getFamilyExceptId($id)
    {
        return ProductFamily::where('id', '!=', $id)->get();
    }

    public function getStatusProduct($id)
    {
        $product =  $this->model->find($id);
        switch ($product->product_status) {
            case (0):
                $status = 'Sắp Ra Mắt';
                break;
            case (1):
                $status = "Đang Bán";
                break;
            case (2):
                $status = "Ngưng Nhập Hàng";
                break;
            case (3):
                $status = "Tạm Hết Hàng";
                break;
        }

        return $status;
    }

    public function getStatusProductExceptStatus($status)
    {
        // dd($status);
        $arrayStatus = [];
        $i = 0;
        while ($i <= 3) {
            switch (true) {
                case ($i == 0 && $i !== $status):
                    $arrayStatus[$i] =  "Sắp Ra Mắt";
                    break;
                case ($i == 1 && $i !== $status):
                    $arrayStatus[$i] =  "Đang Bán";
                    break;
                case ($i == 2 && $i !== $status):
                    $arrayStatus[$i] =  "Ngưng Nhập Hàng";
                    break;
                case ($i == 3 && $i !== $status):
                    $arrayStatus[$i] =  "Tạm Hết Hàng";
                    break;
            }
            $i++;
        }

        // dd($arrayStatus);
        return $arrayStatus;
    }

    public function getCategoryAll()
    {
        return Category::all();
    }

    public function getAttributesByCategoryId($id)
    {
        $attributes = CategoryAttribute::where('category_id', $id)->get();
        // dd($attributes);
        return response()->json(['code' => 200, 'data' => $attributes]);
    }

    public function getAttributesNews($category_id)
    {
        $attributeNews = CategoryAttribute::whereNotIn('id', function ($query) {
            $query->select('attribute_id')->from('attribute_param');
        })->where('category_id', $category_id)->get();
        return $attributeNews;
    }

    public function addAttributes($product_id, $attributes_id, $attributes_value)
    {
        $arrayAttributesId = array();
        foreach ($attributes_id as $attribute_id) {
            $param = AttributeParams::create([
                'product_id' => $product_id,
                'attribute_id' => $attribute_id
            ]);
            array_push($arrayAttributesId, $attribute_id);
        }
        for ($i = 0; $i < count($arrayAttributesId); $i++) {
            $updateValue = AttributeParams::where('attribute_id', $arrayAttributesId[$i])->update([
                'param_value' => $attributes_value[$i]
            ]);
        }
        return true;
    }

    public function updateAttributes($product_id, $attribute_old, $attribute_new, $attributes_value)
    {
        $arrayAttributesIdNew = array();
        $arrayAttributesIdOld = array();
        foreach ($attribute_old as $attributeIdOld) {
            array_push($arrayAttributesIdOld, $attributeIdOld);
        }
        if ($attribute_new !== null) {
            foreach ($attribute_new as $attributeID) {
                $param = AttributeParams::create([
                    'product_id' => $product_id,
                    'attribute_id' => $attributeID
                ]);
                array_push($arrayAttributesIdNew, $attributeID);
            }

            $arrayAttributesId = array_merge($arrayAttributesIdOld, $arrayAttributesIdNew);
            for ($i = 0; $i < count($arrayAttributesId); $i++) {
                $updateValue = AttributeParams::where('attribute_id', $arrayAttributesId[$i])->update([
                    'param_value' => $attributes_value[$i]
                ]);
            }
            return true;
        } else {
            for ($i = 0; $i < count($arrayAttributesIdOld); $i++) {
                // dd($attributes_value[$i]);
                $updateValue = AttributeParams::where('attribute_id', $arrayAttributesIdOld[$i])->where('product_id', $product_id)->update([
                    'param_value' => $attributes_value[$i]
                ]);
            }
            return true;
        }
    }

    public function getCategoryTree(){
        Category::where('category_parent', 0)->with('childrenCategories')->get();
    }

    public function getCart(){
        return Cart::content();
    }

    public function getAttribute($id){
        $attributes = CategoryAttribute::where('category_id', $id)->get();
        return $attributes;
    }


    public function getImport($id){
        return Import::find($id);
    }

    public function getImportAll(){
        return Import::all();
    }

    public function getProduct($id){
        return $this->model->find($id);
    }

    public function getImportPrice($data){
        $import_details = ImportDetail::where('import_id',$data['id'])->where('product_id',$data['product_id'])->first();
        return $import_details;
    }

    public function getImportDetailAll(){
        return ImportDetail::all();
    }

}

<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\CategoryAttribute;
use App\Models\AttributeParams;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       $data =[
           "id" => $this->id,
           "brand_name" => $this->brand_name,
           "brand_description" => $this->brand_description,
           "brand_status" => $this->brand_status,
           "products" => $this->getProducts($this->id),
           "highest_product_price" => $this->getHighestProductPrice($this->id),
           "category_attributes" => $this->getBrandAttributes($this->id),
       ];
       return $data;
    }

    public function getHighestProductPrice($id)
    {
        $product = Product::select('product_price')->where('brand_id', $id)->where('product_price', Product::where('brand_id', $id)->max('product_price'))->first();
        if ($product) {
            return $product->product_price;
        } else {
            return null;
        }
    }

    public function getBrandAttributes($id){
        $product_ids = Product::where('brand_id',$id)->get(['category_id']);
        $category_attributes = CategoryAttribute::whereIn('category_id', $product_ids)->get();

        if (!$category_attributes) {
            return null;
        }
        $data = array();

        $array_attribute_name = array();
        foreach ($category_attributes as $category_attribute) {
            $param = AttributeParams::where('attribute_id', $category_attribute->id)->distinct()->get(['param_value']);
            $value = [
                "attribute_name" => $category_attribute->attribute_name,
                "params" => $param->toArray()
            ];
            if(!in_array($category_attribute->attribute_name,$array_attribute_name)){
                array_push($array_attribute_name, $category_attribute->attribute_name);
                array_push($data, $value);

            }else{
                $index = array_search($category_attribute->attribute_name,$array_attribute_name);

                $data[$index]['params'] = array_merge($data[$index]['params'],$param->toArray());

            }
        }
        return $data;

    }

    public function getProducts($id){
        $products = ProductResource::collection(Product::where('brand_id',$id)->where('product_status',1)->get());
        return $products;
    }
}

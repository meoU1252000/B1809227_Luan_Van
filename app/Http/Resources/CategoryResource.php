<?php

namespace App\Http\Resources;

use App\Models\AttributeParams;
use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
use Attribute;
use Illuminate\Support\Str;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            "id" => $this->id,
            "category_parent" => $this->category_parent,
            "category_slug" => Str::slug($this->category_name),
            "category_name" => $this->category_name,
            "category_status" => $this->category_status,
            "products" => $this->getProduct($this->id),
            'children' => $this->getChildrenCategory($this->id),
            "highest_product_price" => $this->getHighestProductPrice($this->id),
            "category_attributes" => $this->getCategoryAttributes($this->id),
        ];
        return $data;
    }

    public function getProduct($id)
    {
        $products = ProductResource::collection(Product::where('category_id', '=', $id)->where('product_status',1)->get());

        return $products;
    }

    public function getHighestProductPrice($id)
    {
        $product = Product::select('product_price')->where('category_id', $id)->where('product_price', Product::where('category_id', $id)->max('product_price'))->first();
        if ($product) {
            return $product->product_price;
        } else {
            return null;
        }
    }

    public function getCategoryAttributes($id)
    {
        $category_attributes = CategoryAttribute::where('category_id', $id)->get();
        if (!$category_attributes) {
            return null;
        }
        $data = array();

        foreach ($category_attributes as $category_attribute) {
            $param = AttributeParams::where('attribute_id', $category_attribute->id)->distinct()->get(['param_value']);
            $value = [
                "attribute_name" => $category_attribute->attribute_name,
                "params" => $param
            ];
            array_push($data, $value);
        }
        return $data;
    }

    public function getChildrenCategory($id)
    {

        $categories = CategoryResource::collection(Category::where('category_parent', $id)->where('category_status',1)->get());
        return $categories;
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Image;
use App\Models\ImportDetail;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductRatingResource;
use App\Http\Resources\ProductCommentResource;
use App\Models\AttributeParams;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\ProductFamily;
use App\Models\ProductComment;
use Illuminate\Support\Str;

class ProductResource extends JsonResource
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
            "brand" => $this->getBrand($this->brand_id),
            "kind" => $this->getKind($this->category_id),
            "category" => $this->getCategory($this->category_id),
            "category_root" => $this->getCategoryRoot($this->category_id),
            "product_name" => $this->product_name,
            "product_quantity_stock" => $this->getProductQuantityStock($this->id),
            "product_sold" => $this->product_sold,
            "main_image_src" => url($this->main_image_src),
            "product_price" => $this->product_price,
            "product_description" => $this->product_description,
            "product_status" => $this->product_status,
            "images" => $this->getImages($this->id),
            "product_attribute" => $this->getProductAttribute($this->id),
            "product_comment" => $this->getProductComment($this->id),
            "product_star" => $this->getProductStar($this->id),
            "product_star_content" => $this->getProductStarContent($this->id),
        ];
        return $data;
    }

    public function getBrand($id)
    {
        $brand = Brand::find($id);
        return $brand;
    }

    public function getCategoryRoot($id){
        $category = Category::find($id);
        if($category->category_parent == 0 ){
            return $category->category_name;
        }
        return $this->getCategoryRoot($category->category_parent);
    }

    public function getProductStarContent($id){
        return ProductRatingResource::collection(ProductRating::where('product_id', $id)->orderBy('id','desc')->get());
    }

    public function getProductPrice($id){
        $import_detail = ImportDetail::where('product_id', $id)->where('import_product_quantity','>',0)->oldest()->first();
        if($import_detail){
            return $import_detail->import_price_sell;
        }
        return 0;
    }

    public function getProductQuantityStock($id){
        $import_detail = ImportDetail::where('product_id', $id)->where('import_product_quantity','>',0)->oldest()->first();
        if($import_detail){
            return $import_detail->import_product_stock;
        }
        return 0;
    }

    public function getProductStar($id){
        $product_rating_5 = ProductRating::where('star_rating_number',5)->where('product_id',$id)->get()->count();
        $product_rating_4 = ProductRating::where('star_rating_number',4)->where('product_id',$id)->get()->count();
        $product_rating_3 = ProductRating::where('star_rating_number',3)->where('product_id',$id)->get()->count();
        $product_rating_2 = ProductRating::where('star_rating_number',2)->where('product_id',$id)->get()->count();
        $product_rating_1 = ProductRating::where('star_rating_number',1)->where('product_id',$id)->get()->count();
        $data = [
            "star_5" => $product_rating_5,
            "star_4" => $product_rating_4,
            "star_3" => $product_rating_3,
            "star_2" => $product_rating_2,
            "star_1" => $product_rating_1,
            "total" => $product_rating_5 + $product_rating_4 + $product_rating_3 + $product_rating_2 + $product_rating_1,
        ];
        return $data;
    }

    public function getProductComment($id){
        return ProductCommentResource::collection(ProductComment::where('product_id', $id)->where('comment_parent',0)->get());
    }

    public function getKind($id)
    {
        $kind = Category::find($id);
        return Str::slug($kind->category_name, '-');
    }

    public function filterAttribute($id)
    {
        $product = Product::find($id);
        $attribute_param = CategoryAttribute::where('category_id', $product->category_id)->distinct()->get(['id']);
        $params_product = AttributeParams::where('product_id', $id)->distinct()->get(['param_value']);
        $other_params = AttributeParams::whereIn('attribute_id', $attribute_param)->whereNotIn('param_value', $params_product)->distinct()->get();
        $data = array();
        $product_ids_dict = [];

        foreach ($other_params as $other_param) {
            $category_attribute = CategoryAttribute::find($other_param->attribute_id);

            $value = [
                "product_id" => $other_param->product_id,
                "params" => [[
                    "attribute_name" => $category_attribute->attribute_name,
                    "param_value" => [$other_param->param_value]
                ]]
            ];
            $product_id = $value['product_id'];
            if (array_key_exists($product_id, $product_ids_dict)) {
                $attribute_index = $product_ids_dict[$product_id]['attribute_index'];
                ++$product_ids_dict[$product_id]["count"];
                $data[$attribute_index]['params'] = array_merge($data[$attribute_index]['params'], $value['params']);
            } else {
                $product_ids_dict[$product_id] = [
                    "attribute_index" => count($data),
                    "count" => 1
                ];
                array_push($data, $value);
            }
        }
        // array_push($data,$value);

        return $data;
    }

    // public function getProductFamily($id, $product_id)
    // {
    //     $family = ProductFamily::find($id);
    //     if ($family) {
    //         $product_in_family = Product::where('product_family_id', $id)->get();
    //         $data = [
    //             "family" => $family,
    //             "attribute" => []
    //         ];
    //         $product_ids_dict = [];
    //         foreach ($product_in_family as $product) {
    //             $params = AttributeParams::where('product_id', $product->id)->get();
    //             foreach ($params as $param) {
    //                 $category_attribute = CategoryAttribute::find($param->attribute_id);

    //                 $value = [
    //                     "attribute_name" => $category_attribute->attribute_name,
    //                     "param" => [[
    //                         "product_id" => $param->product_id,
    //                         "param_value" => $param->param_value
    //                     ]]
    //                 ];


    //                 $attribute_name = $value['attribute_name'];
    //                 if (array_key_exists($attribute_name, $product_ids_dict)) {
    //                     $attribute_index = $product_ids_dict[$attribute_name]['attribute_index'];
    //                     ++$product_ids_dict[$attribute_name]["count"];
    //                     $data['attribute'][$attribute_index]['param'] = array_merge($data['attribute'][$attribute_index]['param'], $value['param']);
    //                 } else {
    //                     $product_ids_dict[$attribute_name] = [
    //                         "attribute_index" => count($data['attribute']),
    //                         "count" => 1
    //                     ];
    //                     array_push($data['attribute'], $value);
    //                 }
    //             }
    //         }
    //         return $data;
    //     }
    //     return null;
    // }

    public function getCategory($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category_attributes = CategoryAttribute::where('category_id', $id)->get();
            if (!$category_attributes) {
                return null;
            }
            $data = [
                "category" => $category,
                "attribute" => []
            ];

            $product_ids_dict = [];

            foreach ($category_attributes as $category_attribute) {
                $params = AttributeParams::where('attribute_id', $category_attribute->id)->distinct()->get(['param_value']);

                foreach ($params as $param) {
                    $value = [
                        "attribute_name" => $category_attribute->attribute_name,
                        "param" => [[
                            "param_value" => $param->param_value,
                        ]]
                    ];
                    $attribute_name = $value['attribute_name'];
                    if (array_key_exists($attribute_name, $product_ids_dict)) {
                        $attribute_index = $product_ids_dict[$attribute_name]['attribute_index'];
                        ++$product_ids_dict[$attribute_name]["count"];
                        $data['attribute'][$attribute_index]['param'] = array_merge($data['attribute'][$attribute_index]['param'], $value['param']);
                    } else {
                        $product_ids_dict[$attribute_name] = [
                            "attribute_index" => count($data['attribute']),
                            "count" => 1
                        ];
                        array_push($data['attribute'], $value);
                    }
                }
            }

            return $data;
        }
        return null;
    }

    public function getImages($id)
    {
        $images = ImageResource::collection(Image::where('product_id', $id)->get());
        if (count($images)) {
            return $images;
        }
        return null;
    }

    public function getProductAttribute($id)
    {
        $data = array();
        $params = AttributeParams::where('product_id', $id)->orderBy('attribute_id')->get();
        if (count($params)) {
            foreach ($params as $param) {
                $attribute = CategoryAttribute::find($param->attribute_id);
                $value = [
                    "attribute_name" => $attribute->attribute_name,
                    "params" => $param->param_value
                ];
                array_push($data, $value);
            }
            return $data;
        }
        return null;
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Product;
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
           "products" => $this->getProducts($this->id)
       ];
       return $data;
    }

    public function getProducts($id){
        $products = ProductResource::collection(Product::where('brand_id',$id)->get());
        return $products;
    }
}

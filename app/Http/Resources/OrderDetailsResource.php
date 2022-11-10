<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            "order_id" => $this->order_id,
            "product" => $this->getProduct($this->product_id),
            "product_price" => $this->product_price,
            "product_number" => $this->product_number,
            "star_rating" => $this->getStarRating($this->order_id,$this->product_id),
        ];
        return $data;
    }

    public function getStarRating($order_id,$product_id){
        $product_rating = ProductRating::where('order_id', $order_id)->where('product_id',$product_id)->first();
        return $product_rating->star_rating_number;
    }

    public function getProduct($id){
        return new ProductResource(Product::find($id));
    }
}

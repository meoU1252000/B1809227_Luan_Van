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
        ];
        return $data;
    }

    public function getProduct($id){
        return new ProductResource(Product::find($id));
    }
}

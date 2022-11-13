<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\OrderDetail;
use App\Models\Product;

class ReveunueResource extends JsonResource
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
            "product_name" => $this->product_name,
            "product_price" => $this->product_price,
            "product_quantity" => $this->getProductQuantity($this->id),
            "total_price" => $this->getProductTotalPrice($this->id),
        ];
        return $data;
    }

    public function getProductQuantity($id){
        $order_detail = OrderDetail::where('product_id', $id)->get();
        $quantity = 0;
        foreach($order_detail as $order){
            $quantity += $order->product_number;
        }
        return $quantity;
    }

    public function getProductTotalPrice($id){
        $order_detail = OrderDetail::where('product_id', $id)->get();
        $total_price = 0;
        foreach($order_detail as $order){
            $total_price += $order->product_price * $order->product_number;
        }
        return $total_price;
    }
}

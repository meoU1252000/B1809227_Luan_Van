<?php

namespace App\Http\Resources;

use App\Models\Customer_Address;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "customer_name" => $this->customer_name,
            "customer_phone" => $this->customer_phone,
            "email" => $this->email ,
            "address" => $this->getAddress($this->id),
            "orders" => $this->getOrders($this->id),
        ];
        return $data;
    }

    public function getAddress($id){
        $address = Customer_Address::where('customer_id',$id)->get();
        return $address;
    }

    public function getOrders($id){
        $customer_address = Customer_Address::where('customer_id',$id)->get(['id']);
        $orders = Order::whereIn('address_id',$customer_address)->get();
        return OrderResource::collection($orders);
    }
}

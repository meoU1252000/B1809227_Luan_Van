<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer_Address;
use App\Models\OrderDetail;

class OrderResource extends JsonResource
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
            "staff_id" => $this->staff_id,
            "event_id" => $this->event_id,
            "receive_date" => $this->receive_date,
            "address" => $this->getAddress($this->address_id),
            "order_status" => $this->order_status,
            "note" => $this->note,
            "payment" => $this->payment,
            "total_price" => $this->total_price ,
            "order_details" => $this->getOrderDetails($this->id),
            "created_at" => $this->created_at
        ];
        return $data;

    }

    public function getAddress($id){
        $address = Customer_Address::find($id);
        return $address;
    }

    public function getOrderDetails($id){
        return OrderDetailsResource::collection(OrderDetail::where('order_id',$id)->get());
    }
}

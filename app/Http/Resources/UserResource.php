<?php

namespace App\Http\Resources;

use App\Models\Customer_Address;
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
            "user_name" => $this->brand_name,
            "user_phone" => $this->brand_description,
            "user_email" => $this->brand_status,
            "address" => $this->getAddress($this->id)
        ];
        return $data;
    }

    public function getAddress($id){
        $address = Customer_Address::where('customer_id',$id)->get();
        return $address;
    }
}

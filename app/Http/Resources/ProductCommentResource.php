<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer;
use App\Models\Staff;

class ProductCommentResource extends JsonResource
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
            "product_id" => $this->product_id,
            "customer" => $this->getCustomer($this->customer_id),
            "staff" => $this->getStaff($this->staff_id),
            "comment_content" => $this->comment_content,
            "created_at" => $this->created_at
        ];
        return $data;
    }

    public function getCustomer($id){
        return Customer::find($id);
    }

    public function getStaff($id){
        return Staff::find($id);
    }
}

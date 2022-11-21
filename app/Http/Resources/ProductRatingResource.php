<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer;

class ProductRatingResource extends JsonResource
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
            "customer" => $this->getCustomer($this->customer_id),
            "star_rating_number" => $this->star_rating_number,
            "rating_comment" => $this->rating_comment,
            "created_at" => $this->created_at
        ];
        return $data;
    }

    public function getCustomer($id){
        return Customer::find($id);
    }
}

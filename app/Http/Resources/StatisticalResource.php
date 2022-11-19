<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticalResource extends JsonResource
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
            "cost_price" => $this->product_price,
            "product_turnover" => $this->getProductTurnOver($this->id),
            "total_price" => $this->getProductTotalPrice($this->id),
        ];
        return $data;
    }
}

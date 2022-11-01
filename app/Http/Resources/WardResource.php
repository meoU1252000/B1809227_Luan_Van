<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WardResource extends JsonResource
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
            "code" => $this->code,
            'district_code'=> $this->district_code,
            'administrative_unit_id' => $this->administrative_unit_id,
            'name'=> $this->name,
            'name_en'=> $this->name_en,
            'full_name'=> $this->full_name,
            'full_name_en'=> $this->full_name_en,
            'code_name'=> $this->code_name,
        ];
        return $data;
    }
}

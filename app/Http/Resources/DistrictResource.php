<?php

namespace App\Http\Resources;

use App\Models\Ward;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'province_code'=> $this->province_code,
            'administrative_unit_id' => $this->administrative_unit_id,
            'name'=> $this->name,
            'name_en'=> $this->name_en,
            'full_name'=> $this->full_name,
            'full_name_en'=> $this->full_name_en,
            'code_name'=> $this->code_name,
            'wards' => $this->getWards($this->code),
        ];
        return $data;
    }

    public function getWards($id){
        $wards = Ward::where('district_code',$id)->get();
        return WardResource::collection($wards);
    }
}

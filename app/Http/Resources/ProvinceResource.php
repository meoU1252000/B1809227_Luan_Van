<?php

namespace App\Http\Resources;

use App\Models\District;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'administrative_unit_id' => $this->administrative_unit_id,
            'administrative_region_id'=> $this->administrative_region_id,
            'name'=> $this->name,
            'name_en'=> $this->name_en,
            'full_name'=> $this->full_name,
            'full_name_en'=> $this->full_name_en,
            'code_name'=> $this->code_name,
            'districts' => $this->getDistrict($this->code),
        ];
        return $data;
    }

    public function getDistrict($id){
        $districts = District::where('province_code',$id)->get();
        return DistrictResource::collection($districts);
    }
}

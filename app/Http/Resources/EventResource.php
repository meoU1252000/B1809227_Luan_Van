<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\EventDetails;

class EventResource extends JsonResource
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
            "event_name" => $this->event_name,
            "event_description" => $this->event_description,
            "event_start" => $this->event_start,
            "event_end" => $this->event_end,
            "code" => $this->getCode($this->id),
        ];
        return $data;
    }

    public function getCode($id){
        $codes = EventDetails::where('event_id', $id)->get();
        if($codes){

            $data = array();
            foreach($codes as $code){
                $value = [
                    "id"=> $code->id,
                    "code_name" => $code->code_name,
                    "discount_value" => $code->discount_value,
                    "discount_unit" => $code->discount_unit,
                ];
                array_push($data, $value);
            }
            return $data;
        }else {
            return [];
        }
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\ProductComment;

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
            "comment_parent" => $this->comment_parent,
            "product_id" => $this->product_id,
            "customer" => $this->getCustomer($this->customer_id),
            "comment_content" => $this->comment_content,
            "children" => $this->getChildren($this->id),
            "created_at" => $this->created_at,
            "is_active" => false,
        ];
        return $data;
    }

    public function getCustomer($id){
        return Customer::find($id);
    }

    public function getChildren($id){
        return ProductCommentResource::collection(ProductComment::where('comment_parent',$id)->get());
    }
}

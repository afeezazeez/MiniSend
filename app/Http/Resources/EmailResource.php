<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'from_email'=>$this->from_email,
            'to_email'=>$this->to_email,
            'subject'=>$this->subject,
            'status'=>$this->status,
            'sent_at'=>$this->created_at,

        ];
    }
}

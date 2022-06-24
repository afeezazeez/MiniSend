<?php

namespace App\Http\Resources;

use App\Http\Resources\EmailAttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailShowResource extends JsonResource
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
            'text_content'=>$this->text_content,
            'html_content'=>$this->html_content,
            'sent_at'=>$this->created_at,
            'attachments'=>EmailAttachmentResource::collection($this->attachments)
        ];
    }
}

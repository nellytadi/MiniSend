<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'from'=>$this->from,
            'to'=>$this->to,
            'subject' => $this->subject,
            'text_content'=>$this->text_content,
            'html_content'=> $this->html_content,
            'status'=> $this->status
        ];
    }
}

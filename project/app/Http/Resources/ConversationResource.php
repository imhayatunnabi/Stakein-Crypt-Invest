<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ConversationResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id == 0 ? 'admin' : $this->user_id,
            'conversation_id' => $this->conversation_id,
            'message' => $this->message,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => $this->updated_at,
        ];
    }
}

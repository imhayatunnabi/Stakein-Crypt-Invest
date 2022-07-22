<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'user_id' => $this->user_id,
            'receiver_id' => $this->receiver_id,
            'email' => $this->email,
            'amount' => $this->amount,
            'type' => $this->type,
            'txnid' => $this->txnid,
            'created_at' => $this->created_at,
        ];
    }
}

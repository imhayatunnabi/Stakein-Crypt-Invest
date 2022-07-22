<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawResource extends JsonResource
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
            'method' => $this->method,
            'amount' => $this->amount,
            'fee' => $this->fee,
            'details' => $this->details,
            'status' => $this->status,
            'created_at' => $this->created_at
          ];
    }
}

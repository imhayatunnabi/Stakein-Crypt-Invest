<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
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
            'id'=> $this->id,
            'deposit_number'=> $this->deposit_number,
            'txnid'=> $this->txnid,
            'charge_id'=> $this->charge_id,
            'currency_id'=> $this->currency_id,
            'user_id'=> $this->user_id,
            'amount'=> (float)$this->amount,
            'method'=> $this->method,
            'status'=> $this->status,
            'created_at'=> $this->created_at,
        ];
    }
}

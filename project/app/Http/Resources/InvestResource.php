<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestResource extends JsonResource
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
            'title' => $this->title,
            'min_price' => (float)$this->min_price,
            'max_price' => (float)$this->max_price,
            'payout_days' => (int)$this->days,
            'percentage' => (int)$this->percentage,
            'details' => $this->details,
        ];
    }
}

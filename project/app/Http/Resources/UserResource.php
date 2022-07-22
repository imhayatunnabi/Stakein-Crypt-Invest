<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'fax' => $this->fax,
            'propic' => url('/') . '/assets/images/' . $this->photo,
            'zip_code' => $this->zip,
            'city' => $this->city,
            'address' => $this->address,
            'balance' => $this->income,
            'email_verified' => $this->email_verified,
            'affilate_code' => $this->affilate_code,
            'affilate_link' => url('/').'/?reff='.$this->affilate_code,
            'is_kyc' => $this->is_kyc,
            'kyc_info' => $this->details,
            'is_banned' => $this->ban,
          ];
    }
}

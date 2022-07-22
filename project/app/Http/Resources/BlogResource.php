<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'slug' => $this->slug,
            'photo' => url('/').'/assets/images/'.$this->photo,
            'details' => $this->details,
            'views' => $this->views,
            'status' => $this->status,
            'meta_tag' => $this->meta_tag,
            'meta_description' => $this->meta_description,
            'tags' => $this->tags,
            'created_at' => $this->created_at
        ];
    }
}

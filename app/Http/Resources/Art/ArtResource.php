<?php

namespace App\Http\Resources\Art;

use App\Http\Resources\Artist\ArtistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'art';

    public function toArray($request)
    {
        return [
            'title' => $this->resource->title,
            'artist' => new ArtistResource($this->resource->artist),
            'year' => $this->resource->year,
            'value' => "$" . $this->resource->value,
            'art form' => $this->resource->form->name,
        ];
    }
}

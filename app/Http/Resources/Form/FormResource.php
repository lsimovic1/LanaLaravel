<?php

namespace App\Http\Resources\Form;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'form';

    public function toArray($request)
    {
        return [
            'art form' => $this->resource->name
        ];
    }
}

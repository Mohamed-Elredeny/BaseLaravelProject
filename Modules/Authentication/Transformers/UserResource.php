<?php

namespace Modules\Authentication\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id
        ];
    }
}

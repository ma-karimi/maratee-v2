<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'user_title' => $this->title,
            'user_first_name' => $this->first_name,
            'user_last_name' => $this->last_name,
        ];
    }
}

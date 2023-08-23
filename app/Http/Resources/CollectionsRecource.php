<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionsRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'target_amount' => $this->target_amount,
            'link' => $this->link,
            'user' => new UserResource($this->whenLoaded('user')),
            'contributors' => ContributorsRecource::collection(
                $this->whenLoaded('contributors')
            )
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'user' => $this->whenLoaded('user', fn () => new UserResource($this->user)),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'summary' => $this->summary,
            'ds_division' => $this->ds_division,
            'date_of_birth' => $this->date_of_birth->format('Y-m-d'), // Format the date of birth
            'created_at' => $this->created_at->toDateTimeString(), // Formatting the timestamp
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

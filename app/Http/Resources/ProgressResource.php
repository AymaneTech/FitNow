<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "height" => $this->height,
            "weight" => $this->weight,
            "status" => $this->status,
            "performance" => json_decode($this->performance),
            "measurements" => json_decode($this->measurements),
        ];
    }
}

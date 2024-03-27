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
            "height" => $request->height,
            "weight" => $request->weight,
            "status" => $request->status,
            "performance" => $request->performance,
            "measurements" => $request->measurements,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'spraying'=>$this->spraying,
            'seeding'=>$this->seeding,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Http\Requests\UserRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowDroneResource extends JsonResource
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
            'drone_id'=>$this->drone_id,
            'drone_name'=>$this->drone_name,
            'drone_type'=>$this->drone_type,
            'sensor'=>$this->sensor,
            'playoad_capacity'=>$this->playoad_capacity,
            'batter_life'=>$this->batter_life,
            'famer'=> new UserResource($this->user),
            'plans'=> PlanResource::collection($this->plans),
            'maps'=> PlanResource::collection($this->maps),
            'locations'=>  LocationResource::collection($this->locations),
        ];
    }
}

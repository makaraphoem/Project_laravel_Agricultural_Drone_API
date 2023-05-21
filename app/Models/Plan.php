<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'spaying',
        'seeding',
        'start_date',
        'end_date',
    ];
    public static function plan($request, $id=null){
        $plan = $request->only(['spaying', 'seeding', 'start_date', 'end_date']);
        $plan = self::updateOrCreate(['id'=>$id], $plan);
        $drones = request('drones');
        $plan->drones()->sync($drones);
        return $plan;
    }

    public function drones(){
        return $this->belongsToMany(Drone::class, 'plan_drones')->withTimestamps();
    }
}

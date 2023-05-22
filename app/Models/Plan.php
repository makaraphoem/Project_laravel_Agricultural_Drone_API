<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'spraying',
        'seeding',
        'start_date',
        'end_date',
        'area',
    ];
    public static function plan($request, $id=null){
        $plan = $request->only(['user_id','spraying', 'seeding', 'start_date', 'end_date','area']);
        $plan = self::updateOrCreate(['id'=>$id], $plan);
        $drones = request('drones');
        $plan->drones()->sync($drones);
        return $plan;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function drones(){
        return $this->belongsToMany(Drone::class, 'plan_drones')->withTimestamps();
    }
}

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
        'name',
        'spraying',
        'seeding',
        'start_date',
        'end_date',
        'area',
        'user_id',
    ];
    public static function plan($request, $id=null){
        $plan = $request->only(['name','spraying', 'seeding', 'start_date', 'end_date','area','user_id']);
        $plan = self::updateOrCreate(['id'=>$id], $plan);
        $drones = request('drones');
        $plan->drones()->sync($drones);
        return $plan;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function drones()
    {
        return $this->belongsToMany(Drone::class, 'drone_plans')->withTimestamps();
    }
    public function indructions()
    {
        return $this->hasMany(Indruction::class);
    }
}

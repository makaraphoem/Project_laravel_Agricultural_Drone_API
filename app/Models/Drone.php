<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_name',
        'sensor',
        'playoad_capacity',
        'batter_life',
        'user_id',
        'location_id',
        'map_id',
        'drone_type_id'
    ];

    public static function drone($request, $id=null)
    {
        $drone = $request->only(['drone_name', 'sensor', 'playoad_capacity', 'batter_life','user_id', 'location_id', 'map_id', 'drone_type_id']);
        $drone = self::updateOrCreate(['id'=>$id], $drone);
        return $drone;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans(){
        return $this->belongsToMany(Plan::class, 'plan_drones')->withTimestamps();
    }

    public function map(){
        return $this->belongsTo(Map::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function droneType(){
        return $this->belongsTo(DroneType::class);
    }

}

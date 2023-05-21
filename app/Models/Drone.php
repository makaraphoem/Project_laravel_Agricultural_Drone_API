<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_name',
        'sensor',
        'playoad_capacity',
        'batter_life',
        'famer_id',
        'location_id',
        'map_id',
        'drone_type_id'

    ];

    public static function drone($request, $id=null)
    {
        $drone = $request->only(['drone_name', 'sensor', 'playoad_capacity', 'batter_life','famer_id', 'location_id', 'map_id', 'drone_type_id']);
        $drone = self::updateOrCreate(['id'=>$id], $drone);
        return $drone;
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
    public function famer(){
        return $this->belongsTo(User::class);
    }
}

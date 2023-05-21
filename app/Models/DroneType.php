<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DroneType extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_type',
        'description',
    ];
    public static function droneType($request, $id=null){
        $droneType = $request->only(['drone_type', 'description']);
        $droneType = self::updateOrCreate(['id'=>$id], $droneType);
        return $droneType;
    }
    public function drones(){
        return $this->hasMany(Drone::class);
    }
}

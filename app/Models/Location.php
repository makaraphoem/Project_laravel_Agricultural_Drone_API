<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public static function location($request, $id=null){
        $location = $request->only(['name']);
        $location = self::updateOrCreate(['id'=>$id], $location);
        return $location;
    }
    public function drones(){
        return $this->hasMany(Drone::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_id',
        'drone_name',
        'drone_type',
        'sensor',
        'playoad_capacity',
        'batter_life',
        'user_id',
    ];

    public static function drone($request, $droneId=null)
    {
        $drone = $request->only(['drone_id', 'drone_name', 'drone_type', 'sensor', 'playoad_capacity', 'batter_life','user_id']);
        $drone = self::updateOrCreate(['drone_id'=>$droneId], $drone);
        return $drone;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans(){
        return $this->belongsToMany(Plan::class, 'drone_plans')->withTimestamps();
    }

    public function maps(){
        return $this->hasMany(Map::class);
    }
    
    public function locations(){
        return $this->hasMany(Location::class);
    }

    public function indructions(){
        return $this->hasMany(Indruction::class);
    }
}

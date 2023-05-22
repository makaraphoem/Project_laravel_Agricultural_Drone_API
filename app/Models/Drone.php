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

    public function farmer()
    {
        return $this->belongsTo(User::class);
    }
    
    public function plans(){
        return $this->belongsToMany(Plan::class, 'plan_drones')->withTimestamps();
    }
}

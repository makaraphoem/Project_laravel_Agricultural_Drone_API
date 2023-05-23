<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'drone_id',
    ];
    public static function location($request, $id=null){
        $location = $request->only(['name', 'latitude', 'longitude', 'drone_id']);
        $location = self::updateOrCreate(['id'=>$id], $location);
        return $location;
    }
 
    public function drone()
    {
        return $this->belongsTo(Drone::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'drone_id',
        'farm_id',
    ];
    public static function map($request, $id=null){
        $map = $request->only(['name', 'image', 'drone_id', 'farm_id']);
        $map = self::updateOrCreate(['id'=>$id], $map);
        return $map;
    }
    
    public function drone()
    {
        return $this->belongsTo(Drone::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}

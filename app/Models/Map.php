<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'province',
        'image',
        'drone_id'
    ];
    public static function map($request, $id=null){
        $map = $request->only(['province', 'image', 'drone_id']);
        $map = self::updateOrCreate(['id'=>$id], $map);
        return $map;
    }
    
    public function drone()
    {
        return $this->belongsTo(Drone::class);
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }
}

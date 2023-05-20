<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'latitude',
        'longitude',
        'image',
    ];
    public static function map($request, $id=null){
        $map = $request->only(['latitude', 'longitude', 'image']);
        $map = self::updateOrCreate(['id'=>$id], $map);
        return $map;
    }
}

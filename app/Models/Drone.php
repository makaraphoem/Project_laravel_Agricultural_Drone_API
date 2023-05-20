<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sensor',
        'playoad_capacity',
        'batter_life',
    ];

    public static function drone($request, $id=null)
    {
        $drone = $request->only(['name', 'sensor', 'playoad_capacity', 'batter_life']);
        $drone = self::updateOrCreate(['id'=>$id], $drone);
        return $drone;
    }
}

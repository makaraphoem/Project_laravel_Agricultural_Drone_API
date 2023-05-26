<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indruction extends Model
{
    use HasFactory;
    protected $fillable = [
        'charge_the_batteries',
        'download_the_app',
        'find_a_safe_location',
        'take_off_and_fly',
        'drone_id',
        'plan_id',
    ];

    public static function indruction($request, $id=null){
        $indructioin = $request->only(['charge_the_batteries', 'download_the_app','find_a_safe_location','take_off_and_fly', 'drone_id', 'plan_id']);
        $indructioin = self::updateOrCreate(['id' => $id], $indructioin);
        return $indructioin;  
    }

    public function drone()
    {
        return $this->belongsTo(Drone::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
}

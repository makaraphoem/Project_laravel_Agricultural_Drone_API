<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'spaying',
        'seeding',
        'start_date',
        'end_date',
    ];
    public static function plan($request, $id=null){
        $plan = $request->only(['spaying', 'seeding', 'start_date', 'end_date']);
        $plan = self::updateOrCreate(['id'=>$id], $plan);
        return $plan;
    }
}

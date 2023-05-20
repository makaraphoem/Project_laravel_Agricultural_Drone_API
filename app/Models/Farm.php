<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'size',
    ];

    public static function farm($request, $id=null){
        $farm = $request->only(['name','size']);
        $farm = self::updateOrCreate(['id' => $id], $farm);
        return $farm;  
    }
}





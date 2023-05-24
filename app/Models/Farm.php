<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'size',
    ];

    public static function farm($request, $id=null){
        $farm = $request->only(['user_id','name','size']);
        $farm = self::updateOrCreate(['id' => $id], $farm);
        return $farm;  
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maps()
    {
        return $this->hasMany(Map::class);
    }
}





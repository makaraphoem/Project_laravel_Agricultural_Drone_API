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
        'name',
        'size',
        'farming_type',
        'user_id',
        'map_id'
    ];

    public static function farm($request, $id=null){
        $farm = $request->only(['name','size', 'farming_type', 'user_id', 'map_id']);
        $farm = self::updateOrCreate(['id' => $id], $farm);
        return $farm;  
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}





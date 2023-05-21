<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sensor',
        'playoad_capacity',
        'batter_life',
        'user_id',
    ];

    public static function drone($request, $id=null)
    {
        $drone = $request->only(['name', 'sensor', 'playoad_capacity', 'batter_life','user_id']);
        $drone = self::updateOrCreate(['id'=>$id], $drone);
        return $drone;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

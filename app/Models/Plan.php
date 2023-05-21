<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'farmer_id',
        'spraying',
        'seeding',
        'start_date',
        'end_date',
        'area',
    ];
    public static function plan($request, $id=null){
        $plan = $request->only([ 'farmer_id','spraying', 'seeding', 'start_date', 'end_date','area']);
        $plan = self::updateOrCreate(['id'=>$id], $plan);
        return $plan;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

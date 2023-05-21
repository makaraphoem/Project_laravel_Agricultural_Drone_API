<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public static function store($request, $id=null){
        $user = $request->only(['farm_id','name','email','password']);
        $user['password']=Hash::make( $user['password']);
        $user = self::updateOrCreate(['id' => $id], $user);
        return $user;  
    }
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function drones(): HasMany
    {
        return $this->hasMany(Drone::class);
    }
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class);
    }

}

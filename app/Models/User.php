<?php

namespace App\Models;
use App\Models\UserDetails;
use App\Models\Timeline;
use App\Models\Follow;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'email_verified_at',
        'google_id'
    ];

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
    public function getNameAttribute() {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getBioAttribute() {
        return UserDetails::where([
            'key'      => "bio",
            'user_id'  => $this->attributes['id']
        ])->first()->value ?? '';
    }

    public function getDpAttribute() {
        return UserDetails::where([
            'key'      => "dp",
            'user_id'  => $this->attributes['id']
        ])->first()->value ?? '';
    }

    public function posts() {
      return $this->hasMany(Timeline::class, 'user_id')->orderBy('created_at', 'desc');
    }
    public function followers() {
      return $this->hasMany(Follow::class, 'follows')->orderBy('created_at', 'desc');
    }

    public function following() {
      return $this->hasMany(Follow::class, 'user_id')->orderBy('created_at', 'desc');
    }
 }

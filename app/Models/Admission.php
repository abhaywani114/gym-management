<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Admission extends Model
{
    use HasFactory;
    protected $table = 'admission';
    protected $guarded = [];
    public function gym() {
        return $this->hasOne(User::class, 'id', 'gym_id');
      }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

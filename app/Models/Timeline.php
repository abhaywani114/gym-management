<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Timeline extends Model
{
    use HasFactory;
    protected $table = 'timeline';
    protected $guarded = [];
    public function author() {
        return $this->hasOne(User::class, 'id', 'user_id');
      }
}

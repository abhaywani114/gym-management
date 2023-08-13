<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
class Message extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function toUser() {
      return $this->hasOne(User::class, 'id' , 'to');
    }

    public function fromUser() {
      return $this->hasOne(User::class, 'id', 'from');
    }

}

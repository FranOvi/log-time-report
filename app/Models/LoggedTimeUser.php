<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggedTimeUser extends Model
{
    use HasFactory;

    protected $table = 'loggedtime_users';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

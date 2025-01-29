<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';
    protected $fillable = ['email', 'token', 'role_id'];

    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }
}

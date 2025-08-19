<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'passwordHash',
        'email',
        'fullName',
        'phone',
        'active',
    ];

    protected $hidden = [
        'passwordHash',
    ];

    public function agriculteur()
    {
        return $this->hasOne(Agriculteur::class);
    }

    public function agentBNA()
    {
        return $this->hasOne(AgentBNA::class);
    }
}


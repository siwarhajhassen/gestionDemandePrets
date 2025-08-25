<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'city',
        'phone',
    ];

    public function agents()
    {
        return $this->hasMany(AgentBNA::class);
    }
    
    public function agriculteurs()
    {
        return $this->hasMany(Agriculteur::class);
    }
    
    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class);
    }
}
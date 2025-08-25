<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agriculteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agence_id', // Add this
        'CIN',
        'farm_address',
        'farm_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    // Remove controller methods from model
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agriculteur extends Model
{
    protected $fillable = [
        'user_id',
        'nationalId',
        'farmAddress',
        'farmType',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class, 'applicant_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}

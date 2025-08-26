<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agriculteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agence_id', 
        'CIN',
        'farm_address',
        'farm_type',
        'status' 
    ];

      protected $casts = [
        'status' => 'string'
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

     public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
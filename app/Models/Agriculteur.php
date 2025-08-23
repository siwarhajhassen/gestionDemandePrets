<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agriculteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'CIN',
        'farm_address',
        'farm_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    // Methods that would be implemented in a controller
    public function createLoanRequest($dto)
    {
        // Implementation would be in controller
    }

    public function updateDocument($loanRequestId, $file, $type)
    {
        // Implementation would be in controller
    }

    public function submitLoanRequest($loanRequestId)
    {
        // Implementation would be in controller
    }

    public function viewLoanRequests()
    {
        return $this->loanRequests()->get();
    }

    public function sendComplaint($dto)
    {
        // Implementation would be in controller
    }

    public function viewResponse()
    {
        // Implementation would be in controller
    }

    public function updateLoanRequest($id, $dto)
    {
        // Implementation would be in controller
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentBNA extends Model
{
    use HasFactory;
    
    protected $table = 'agent_bna';

    protected $fillable = [
        'user_id',
        'employee_id',
        'agency_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods that would be implemented in a controller
    public function viewAllLoanRequests($filter)
    {
        // Implementation would be in controller
    }

    public function viewAllComplaints()
    {
        // Implementation would be in controller
    }

    public function respondToComplaint($complaintId, $dto)
    {
        // Implementation would be in controller
    }

    public function requestMissingDocuments($loanRequestId, $requestedDocuments)
    {
        // Implementation would be in controller
    }

    public function openLoanRequest($id)
    {
        // Implementation would be in controller
    }

    public function addNoteToFile($loanRequestId, $dto)
    {
        // Implementation would be in controller
    }

    public function changeLoanStatus($loanRequestId, $newStatus, $comment)
    {
        // Implementation would be in controller
    }
}
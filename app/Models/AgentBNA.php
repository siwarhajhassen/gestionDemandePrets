<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentBNA extends Model
{
    protected $fillable = [
        'user_id',
        'employeeId',
        'branch',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function assignedRequests()
    {
        return $this->hasMany(LoanRequest::class, 'agent_bna_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'agent_bna_id');
    }
}

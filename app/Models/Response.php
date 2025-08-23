<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'agent_bna_id',
        'message',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function agentBNA()
    {
        return $this->belongsTo(AgentBNA::class);
    }
}
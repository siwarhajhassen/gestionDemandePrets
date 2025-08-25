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
        'agence_id' // Changed from agency_id to agence_id
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class, 'agence_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Remove controller methods from model - they belong in controllers
}
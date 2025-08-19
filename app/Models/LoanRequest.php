<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    protected $fillable = [
        'applicant_id',
        'agent_bna_id',
        'amountRequested',
        'purpose',
        'status',
        'submissionDate',
        'lastUpdated',
    ];

    protected $attributes = [
        'status' => 'en attente',
    ];

    protected $dates = [
        'submissionDate',
        'lastUpdated',
    ];

    // Relations
    public function agriculteur()
    {
        return $this->belongsTo(Agriculteur::class, 'applicant_id');
    }

    public function agentBNA()
    {
        return $this->belongsTo(AgentBNA::class, 'agent_bna_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function actionLogs()
    {
        return $this->hasMany(ActionLog::class);
    }

    // Accessor
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amountRequested, 0, ',', ' ') . ' DT';
    }
}


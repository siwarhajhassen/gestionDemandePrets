<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'agriculteur_id',
        'amount_requested',
        'purpose',
        'loan_status',
        'submission_date',
        'last_updated'
    ];

    protected $casts = [
        'submission_date' => 'datetime',
        'last_updated' => 'datetime',
        'amount_requested' => 'double'
    ];

    public function agriculteur()
    {
        return $this->belongsTo(Agriculteur::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function addDocument($doc)
    {
        // Implementation would be in controller
    }

    public function removeDocument($documentId)
    {
        // Implementation would be in controller
    }

    public function setStatus($status, $changedBy, $reason)
    {
        // Implementation would be in controller
    }
}
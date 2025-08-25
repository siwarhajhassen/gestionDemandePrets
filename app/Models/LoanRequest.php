<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class LoanRequest extends Model
{
    use HasFactory, SoftDeletes;

    // AJOUTER agence_id dans les fillable
    protected $fillable = [
        'agriculteur_id',
        'agence_id', // ← AJOUTER CETTE LIGNE
        'amountRequested',
        'purpose',
        'loan_duration',
        'farm_type',
        'land_size',
        'project_description',
        'expected_start_date',
        'expected_completion_date',
        'additional_notes',
        'status',
        'submissionDate',
        'lastUpdated',
    ];

    protected $casts = [
        'submissionDate' => 'datetime',
        'lastUpdated' => 'datetime',
        'amountRequested' => 'double',
        'land_size' => 'double',
        'expected_start_date' => 'date',
        'expected_completion_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Accesseurs (corrects)

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

    // AJOUTER CETTE RELATION
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
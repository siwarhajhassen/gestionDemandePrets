<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class LoanRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agriculteur_id',
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

    // Accesseur pour submissionDate
    public function getSubmissionDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    // Accesseur pour lastUpdated
    public function getLastUpdatedAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    // Accesseur pour expected_start_date
    public function getExpectedStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    // Accesseur pour expected_completion_date
    public function getExpectedCompletionDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

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
}
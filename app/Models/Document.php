<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_request_id',
        'file_name',
        'file_type',
        'storage_path',
        'document_type',
        'uploaded_at'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime'
    ];

    public function loanRequest()
    {
        return $this->belongsTo(LoanRequest::class);
    }
}
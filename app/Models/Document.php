<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'loan_request_id',
        'fileName',
        'fileType',
        'storagePath',
        'size',
        'type',
        'uploadedAt',
        'uploadedBy_id',
    ];

    public function loanRequest()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_request_id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploadedBy_id');
    }
}

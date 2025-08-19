<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'author_id',
        'subject',
        'message',
        'status',
        'related_loan_request_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function relatedLoanRequest()
    {
        return $this->belongsTo(LoanRequest::class, 'related_loan_request_id');
    }

    public function response()
    {
        return $this->hasOne(Response::class);
    }
}

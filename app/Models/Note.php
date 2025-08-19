<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'author_id',
        'loan_request_id',
        'content',
        'visibility',
        'createdAt',
    ];

    public function author()
    {
        return $this->belongsTo(AgentBNA::class, 'author_id');
    }

    public function loanRequest()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_request_id');
    }
}

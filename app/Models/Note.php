<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_request_id',
        'content',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function loanRequest()
    {
        return $this->belongsTo(LoanRequest::class);
    }

    public function edit($newContent)
    {
        $this->content = $newContent;
        $this->save();
    }

    public static function createNote($content, $loanRequestId)
    {
        return self::create([
            'content' => $content,
            'loan_request_id' => $loanRequestId
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    protected $fillable = [
        'action',
        'performedBy_id',
        'timestamp',
        'details',
    ];

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performedBy_id');
    }
}

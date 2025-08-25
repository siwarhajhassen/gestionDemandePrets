<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'agriculteur_id',
        'subject',
        'message',
        'status',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function agriculteur()
    {
        return $this->belongsTo(Agriculteur::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    // AJOUTER CETTE MÉTHODE pour accéder à l'agence via l'agriculteur
    public function agence()
    {
        return $this->through('agriculteur')->has('agence');
    }
}
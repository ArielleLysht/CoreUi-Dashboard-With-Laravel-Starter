<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type_id',
        'niveau',
        'statut',
        'role_id',
        'comment',
        'annee',
    ];
}

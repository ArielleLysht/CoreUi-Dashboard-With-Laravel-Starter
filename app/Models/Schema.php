<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
        'role_id',
        'Ordre',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'genre',
        'date_naissance',
        'lieux_naissance',
        'phone',
        'nin',
        'cnas',
        'date_recrutement',
    ];
}

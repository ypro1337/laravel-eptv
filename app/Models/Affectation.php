<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\configuration\Sieges;
use App\Models\configuration\Structures;

class Affectation extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function structures()
    {
        return $this->belongsTo(Structures::class);
    }     
}

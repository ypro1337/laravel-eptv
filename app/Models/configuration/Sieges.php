<?php

namespace App\Models\configuration;

use App\Casts\SlugCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sieges extends Model
{
    use HasFactory;
    protected $fillable = ['designation', 'slug', 'adresse'];

    protected $casts = [
        'slug'=>SlugCast::class.':designation,slug',
    ];

    public function structures()
    {
        return $this->hasMany(Stuctures::class);
    }

}

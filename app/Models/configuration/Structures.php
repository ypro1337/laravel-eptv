<?php

namespace App\Models\configuration;

use App\Casts\SlugCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Structures extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'parent_id'];

    protected $casts = [
        'slug'=>SlugCast::class.':name,slug',
    ];


    public function children()
    {
        return $this->hasMany(Structures::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Structures::class, 'parent_id');
    }  
    
    public function siege()
    {
        return $this->belongsTo(Sieges::class);
    }


    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }

    static function  getDepth($parent_id,$chemin) {

        $structures= Structures::find($parent_id);
 
        if ($structures) {
            if ($structures->parent_id == 0) {
                return $structures->name.'/'.$chemin;
            } else {
                $chemin= $structures->name.'/'.$chemin;
                return self::getDepth($structures->parent_id,$chemin);
            }
        }
 
     }
  

}

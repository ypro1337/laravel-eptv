<?php

namespace App\Casts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SlugCast implements CastsAttributes
{
   
    protected $designation,$slug;

    /**
     *  constructor.
     * @param $designation
     */
    public function __construct($designation,$slug)
    {
        $this->designation = $designation;
        $this->slug = $slug;
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        
        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
       
        $value = $this->uniqueSlug($attributes[$this->designation]);

        return $value;
    }

    private function uniqueSlug($title){
   /*
        $slug = Str::slug($title, '-');
         $count = $model::where('slug', 'LIKE', "{$slug}%")->count();       
        $newCount = $count > 0 ? ++$count : '';        */ 
        return Str::slug($title, '-');
    }
}

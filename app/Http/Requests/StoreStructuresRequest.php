<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;



class StoreStructuresRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
       
       $slug= Str::slug($this->name, '-');  
       //dd($this->siege_id);   
       
        return [
            'siege_id' => 'integer', 
              
            'name' =>  [
                         'required', 
                         Rule::unique('structures')
                                ->where('parent_id', $this->parent_id)
                                ->where('slug', $slug)
                        ]
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStore extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required | max:150',
            'img'=>' ',
            'price'=>'required',
            'description'=>'required | min:100',
            'category_id'=>'required',
        ];
    }

    public function messages() {

        return[

            'title.required'=>'Il titolo è obbligatorio',
            'title.max'=>'Il titolo dev\'essere massimo di 150 caratteri',
            'price.required'=>'E\' necessario inserire il prezzo dell\'articolo',
            'description.required'=>'Devi inserire una descrizione dell\'articolo',
            'description.min'=>'La descrizione è troppo breve',
            'category_id.required'=>'Devi assegnare una categoria al tuo prodotto',

        ];

    }
}

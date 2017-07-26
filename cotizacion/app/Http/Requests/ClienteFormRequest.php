<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            //
            'nombre'=>'required|max:80',
            'domicilio'=>'max:80',
            'telefono'=>'required|max:15',
            'email'=>'required|max:80',
            'empresa'=>'max:80'
        ];
    }
}

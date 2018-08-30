<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Albun2FormRequest extends FormRequest
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
            'idBanda'        => 'required',
                'capa'           => 'image|max:2048|',
                'nome'           => 'required|min:3|max:100|unique:albuns,id,'.$this->get('id'),
                'ano'            => 'required|numeric',
        ];
    }
}

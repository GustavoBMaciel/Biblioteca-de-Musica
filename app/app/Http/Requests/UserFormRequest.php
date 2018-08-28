<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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

                'name'        => 'required|min:3|max:100|',
                //*'imagem'      => 'required|image|max:2048|',
                'permissao'   => 'required',
                'email'       => 'required|string|email|max:255|unique:users,id,'.$this->get('id'),
                'password'    => 'required|string|min:6|confirmed',

        ];
    }
}

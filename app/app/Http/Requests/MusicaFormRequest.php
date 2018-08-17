<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MusicaFormRequest extends FormRequest
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
        return ['nome'        => 'required|min:3|max:100|',
                'duracao'     => 'required|numeric',
                'compositor'  => 'required|min:3|max:100|',
                'numero'      => 'required',
        ];
    }
}

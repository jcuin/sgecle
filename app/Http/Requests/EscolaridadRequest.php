<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EscolaridadRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'escolaridad' => 'unique:cat_escolaridads|required|min:2',
                    'nomenclatura_grupos' => 'unique:cat_escolaridads|required|min:1',
                    'horario' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'escolaridad' => 'required|min:2',
                    'nomenclatura_grupos' => 'required|min:1',
                    'horario' => 'required'
                ];
            }
            default:break;
        }    
    }
}

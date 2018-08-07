<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
                    'id_escolaridad' => 'required|not_in:0',
                    'grupo' => 'unique_with:cat_grupos,grupo,id_escolaridad,id_periodo|required|min:2',
                    'capacidad' => 'required|min:1'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'id_escolaridad' => 'required|not_in:0',
                    'grupo' => 'required|min:2',
                    'capacidad' => 'required|min:1'
                ];
            }
            default:break;
        }    
    }
}

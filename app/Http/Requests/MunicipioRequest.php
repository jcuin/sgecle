<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; 
use App\Municipio;

class MunicipioRequest extends FormRequest
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
                    'id_estado' => 'required|not_in:0',
                    'municipio' => 'required|min:2|unique_with:cat_municipios,municipio,id_estado'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'id_estado' => 'required|not_in:0',
                    'municipio' => 'required|min:2'
                ];
            }
            default:break;
        }
    }
}

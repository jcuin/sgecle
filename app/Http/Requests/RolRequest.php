<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaDeTrabajoRequest extends FormRequest
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
                    'rol_key' => 'unique:cat_roles|required|min:2',
                    'rol' => 'unique:cat_roles|required|min:2',
                    'descripcion' => 'required|min:2'

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'rol_key' => 'required|min:2',
                    'rol' => 'required|min:2',
                    'descripcion' => 'required|min:2'
                ];
            }
            default:break;
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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
                    'nombre' => 'required|min:2',
                    'a_paterno' => 'required|min:2',
                    'a_materno' => 'min:2',
                    'fecha_nacimiento' => 'required|before:today',
                    'telefono' => 'required|min:7',
                    'email' => 'email',
                    'confirmaemail' => 'same:email',
                    'foto' => 'image'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nombre' => 'required|min:2',
                    'a_paterno' => 'required|min:2',
                    'a_materno' => 'min:2',
                    'fecha_nacimiento' => 'required|before:today',
                    'telefono' => 'required|min:7',
                    'email' => 'email',
                    'confirmaemail' => 'same:email',
                    'foto' => 'image'
                ];
            }
            default:break;
        }
    }
}

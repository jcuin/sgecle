<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                    'clave_preescolar' => 'unique:settings|required|min:2',
                    'clave_primaria' => 'unique:settings|required|min:2',
                    'clave_secundaria' => 'unique:settings|required|min:2',
                    'zona_escolar' => 'required|min:2',
                    'rfc_colegio' => 'unique:settings|required|min:2',
                    'razon_social' => 'unique:settings|required|min:2',
                    'domicilio' => 'required|min:2',
                    'telefono_contacto' => 'required|min:2',
                    'correo_electronico' => 'required|min:2',
                    'id_periodo' => 'required|not_in:0',
                    'direccion_general' => 'required|min:2',
                    'direccion_preescolar' => 'required|min:2',
                    'direccion_primaria' => 'required|min:2',
                    'direccion_secundaria' => 'required|min:2',
                    'direccion_ingles' => 'required|min:2'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'clave_preescolar' => 'required|min:2',
                    'clave_primaria' => 'required|min:2',
                    'clave_secundaria' => 'required|min:2',
                    'zona_escolar' => 'required|min:2',
                    'rfc_colegio' => 'required|min:2',
                    'razon_social' => 'required|min:2',
                    'domicilio' => 'required|min:2',
                    'telefono_contacto' => 'required|min:2',
                    'correo_electronico' => 'required|min:2',
                    'id_periodo' => 'required|not_in:0',
                    'direccion_general' => 'required|min:2',
                    'direccion_preescolar' => 'required|min:2',
                    'direccion_primaria' => 'required|min:2',
                    'direccion_secundaria' => 'required|min:2',
                    'direccion_ingles' => 'required|min:2'
                ];
            }
            default:break;
        } 
    }
}

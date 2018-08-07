<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrabajadorRequest extends FormRequest
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
                    'curp' => 'unique:trabajadors|required|min:18|max:18',
                    'rfc' => 'unique:trabajadors|required|min:10',
                    'seguro_social' => 'unique:trabajadors|min:5',
                    'id_estado_civil' => 'required|not_in:0',
                    'id_estado' => 'required|not_in:0',
                    'id_estado_municipio' => 'required|not_in:0',
                    'calle' => 'required|min:2',
                    'colonia' => 'required|min:2',
                    'cp' => 'required|integer|min:5',
                    'telefono' => 'required|min:5',
                    'email' => 'required|email',
                    'confirmaemail' => 'required|same:email',
                    'id_religion' => 'required|not_in:0',
                    'tipo_sangre' => 'required|min:2',
                    'id_rol' => 'required|not_in:0',
                    'id_prep_academica' => 'required|not_in:0',
                    'foto' => 'image',

                    //validaciones del conyuge
                    'nombre_conyuge' => 'required|min:2',
                    'a_paterno_conyuge' => 'required|min:2',
                    'fecha_de_nacimiento_conyuge' => 'required|before:today',
                    'lugar_labora_conyuge' => 'required|min:2',
                    'genero_conyuge' => 'required|not_in:0',
                    'id_conyuge' => 'required|not_in:0',

                    //Validaciones de antecedentes medicos
                    'alergia' => 'required|min:2',
                    'enfermedad' => 'required|min:2',
                    'medicina' => 'required|min:2',
                    'cirugia' => 'required|min:2',
                    'medico' => 'required|min:2',
                    'telefono_medico' => 'required|min:2',
                    'nombre_referencia1' => 'required|min:2',
                    'telefono_referencia1' => 'required|min:2',
                    'nombre_referencia2' => 'required|min:2',
                    'telefono_referencia2' => 'required|min:2',

                    //validaciones de antecedentes laborales
                    'trabajo_anterior' => 'required|min:2',
                    'puesto' => 'required|min:2',
                    'fecha_inicio' => 'required|date|before:today',
                    'fecha_termino' => 'required|date|after:fecha_inicio'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nombre' => 'required|min:2',
                    'a_paterno' => 'required|min:2',
                    'curp' => 'required|min:18|max:18',
                    'rfc' => 'required|min:10',
                    'seguro_social' => 'min:5',
                    'id_estado_civil' => 'required|not_in:0',
                    'id_estado' => 'required|not_in:0',
                    'id_estado_municipio' => 'required|not_in:0',
                    'calle' => 'required|min:2',
                    'colonia' => 'required|min:2',
                    'cp' => 'required|integer|min:5',
                    'telefono' => 'required|min:5',
                    'email' => 'required|email',
                    'confirmaemail' => 'required|same:email',
                    'id_religion' => 'required|not_in:0',
                    'tipo_sangre' => 'required|min:2',
                    'id_rol' => 'required|not_in:0',
                    'id_prep_academica' => 'required|not_in:0',
                    'foto' => 'image',

                    //validaciones del conyuge
                    'nombre_conyuge' => 'required|min:2',
                    'a_paterno_conyuge' => 'required|min:2',
                    'fecha_de_nacimiento_conyuge' => 'required|before:today',
                    'lugar_labora_conyuge' => 'required|min:2',
                    'genero_conyuge' => 'required|not_in:0',
                    'id_conyuge' => 'required|not_in:0',

                    //Validaciones de antecedentes medicos
                    'alergia' => 'required|min:2',
                    'enfermedad' => 'required|min:2',
                    'medicina' => 'required|min:2',
                    'cirugia' => 'required|min:2',
                    'medico' => 'required|min:2',
                    'telefono_medico' => 'required|min:2',
                    'nombre_referencia1' => 'required|min:2',
                    'telefono_referencia1' => 'required|min:2',
                    'nombre_referencia2' => 'required|min:2',
                    'telefono_referencia2' => 'required|min:2',

                    //validaciones de antecedentes laborales
                    'trabajo_anterior' => 'required|min:2',
                    'puesto' => 'required|min:2',
                    'fecha_inicio' => 'required|date|before:today',
                    'fecha_termino' => 'required|date|after:fecha_inicio'
                ];
            }
            default:break;
        }
    }

     public function messages()
    {
        return [
            'nombre.required'    => 'El campo Nombre es obligatorio.',
            'nombre.min'    => 'El campo Nombre debe contener mínimo 2 caracteres.',
            'a_paterno.required'    => 'El campo Apellido Paterno es obligatorio.',
            'a_paterno.min'    => 'El campo Apellido Paterno debe contener mínimo 2 caracteres.',
            'curp.required'    => 'El campo CURP es obligatorio.',
            'curp.min'    => 'El campo CURP debe contener mínimo 18 caracteres.',
            'rfc.required'    => 'El campo RFC es obligatorio.',
            'rfc.min'    => 'El campo RFC debe contener mínimo 10 caracteres.',
            'seguro_social.required'    => 'El campo Número de Seguro Social es obligatorio.',
            'seguro_social.min'    => 'El campo Número de Seguro Social debe contener mínimo 5 caracteres.',
            'id_estado_civil.not_in'    => 'El campo Estado Civil es obligatorio.',
            'id_estado.required'    => 'El campo Estado es obligatorio.',
            'id_estado.not_in'    => 'El campo Estado es obligatorio.',
            'id_estado_municipio.required'    => 'El campo Municipio es obligatorio.',
            'id_estado_municipio.not_in'    => 'El campo Municipio es obligatorio.',
            'calle.required'    => 'El campo Calle es obligatorio.',
            'calle.min'    => 'El campo Calle debe contener mínimo 2 caracteres.',
            'colonia.required'    => 'El campo Colonia es obligatorio.',
            'colonia.min'    => 'El campo Colonia debe contener mínimo 2 caracteres.',
            'cp.required'    => 'El campo Código Postal es obligatorio.',
            'cp.min'    => 'El campo Código Postal debe contener mínimo 5 caracteres.',
            'cp.integer'    => 'El campo Código Postal debe ser numérico.',
            'telefono.required'    => 'El campo Teléfono es obligatorio.',
            'telefono.min'    => 'El campo Teléfono debe contener mínimo 5 caracteres.',
            'email.required' => 'El campo Correo Electónico es obligatorio.',
            'email.email' => 'El campo Correo Electónico debe cumplir con el formato mail@mail.com.',
            'confirmaemail.required' => 'El campo Confirmación de Correo Electónico es obligatorio.',
            'confirmaemail.same' => 'Éste campo debe ser igual a Correo Electónico.', 
            'id_religion.required'    => 'El campo Religión es obligatorio.',
            'id_religion.not_in'    => 'El campo Religión es obligatorio.',
            'tipo_sangre.required'    => 'El campo Tipo de Sangre es obligatorio.',
            'tipo_sangre.min'    => 'El campo Tipo de Sangre debe contener mínimo 2 caracteres.',
            'id_rol.required'    => 'El campo Rol es obligatorio.',
            'id_rol.not_in'    => 'El campo Rol es obligatorio.',
            'nombre_conyuge.required'    => 'El campo Nombre del Conyuge es obligatorio.',
            'nombre_conyuge.min'    => 'El campo Nombre del Conyuge debe contener mínimo 2 caracteres.',
            'a_paterno_conyuge.required'    => 'El campo Apellido Paterno del Conyuge es obligatorio.',
            'a_paterno_conyuge.min'    => 'El campo Apellido Paterno del Conyuge debe contener mínimo 2 caracteres.',
            'fecha_de_nacimiento_conyuge.required' => 'La Fecha de Nacimiento del Conyuge es obligatoria.',
            'fecha_de_nacimiento_conyuge.before' => 'La Fecha de Nacimiento del Conyuge debe ser anterior al día de hoy.',
            'lugar_labora_conyuge.required'    => 'El campo Lugar Donde Labora el Conyuge es obligatorio.',
            'lugar_labora_conyuge.min'    => 'El campo Lugar Donde Labora el Conyuge debe contener mínimo 2 caracteres.',
            'id_conyuge.not_in' => 'El campo Trabajador es obligatorio.'
        ];
    }
}

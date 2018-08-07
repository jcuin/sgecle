<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificacionRequest extends FormRequest
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
                    'mensaje' => 'required|min:2',
                    'caducidad' => 'required|after:yesterday',
                    'destinatario' => 'required|not_in:0'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'mensaje' => 'required|min:2',
                    'caducidad' => 'required|after:yesterday'
                ];
            }
            default:break;
        }
    }
}

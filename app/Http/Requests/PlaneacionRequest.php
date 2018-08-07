<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaneacionRequest extends FormRequest
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
                    'grupo' => 'required|not_in:0',
                    'semana' => 'required|not_in:0',
                    'comentarios' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'grupo' => 'required|not_in:0',
                    'semana' => 'required|not_in:0'
                ];
            }
            default:break;
        }
    }
}


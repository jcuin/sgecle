<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
                    'id_periodo' => 'required|not_in:0',
                    'id_escolaridad' => 'required|not_in:0',
                    'evento' => 'required|min:2'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'id_periodo' => 'required|not_in:0',
                    'id_escolaridad' => 'required|not_in:0',
                    'evento' => 'required|min:2'
                ];
            }
            default:break;
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        return [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => '- Поле :attribute обов\'язкове для заповнення',
            'phone.unique' => '- Телефон вже використовується'
        ];
    }
}

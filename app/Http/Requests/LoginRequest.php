<?php

namespace App\Http\Requests;

use App\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    use Response;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'email|required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'O campo email é inválido',
            'email.required' => 'O campo email é obrigatório',
            'password' => 'O campo password é obrigatório'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $data = [
            'error' => 'Parâmetro inválido',
            'message' => $validator->errors()->first()
        ];
        throw new HttpResponseException($this->apiResponse($data,422));
    }
}

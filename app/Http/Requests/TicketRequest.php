<?php

namespace App\Http\Requests;

use App\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                //
            ];
        }

        $rule = [
            'purchaser.name' => 'required',
            'purchaser.email' => 'required|email',
            'purchaser.cpf' => 'required|cpf',
            'purchaser.birth_date' => 'required',
            'seat_id' => 'required|exists:seats,id',
            'qty_tickets' => 'required',
            'has_baggage_exceeded' => 'required|boolean'
        ];

        if ($this->qty_tickets > 1) {
            $rule['passengers.*.name'] = 'required';
            $rule['passengers.*.email'] = 'required|email';
            $rule['passengers.*.cpf'] = 'required|cpf';
            $rule['passengers.*.birth_date'] = 'required';
            $rule['passengers.*.seat_id'] = 'required|exists:seats,id';
            $rule['passengers.*.has_baggage_exceeded'] = 'required|boolean';
        }
        return $rule;
    }

    protected function failedValidation(Validator $validator)
    {
        $data = [
            'error' => 'Parâmetro inválido',
            'message' => $validator->errors()->first()
        ];
        throw new HttpResponseException($this->apiResponse($data, 422));
    }
}

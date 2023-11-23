<?php

namespace App\Http\Requests;

use App\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FlightRequest extends FormRequest
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
            'departure_date' => 'required',
            'flight_origin_id' => 'required|exists:airports,id|different:flight_destination_id',
            'flight_destination_id' => 'required|exists:airports,id|different:flight_origin_id',
            'flight_class' => 'array|required',
            'flight_class.*.seats_qty' => 'required|numeric',
            'flight_class.*.flight_class_type_id' => 'required|numeric|exists:flight_class_types,id',
            'flight_class.*.price' => 'required|numeric',
        ];
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

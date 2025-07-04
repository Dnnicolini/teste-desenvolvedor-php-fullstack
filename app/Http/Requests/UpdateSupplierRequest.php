<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cpf_cnpj' => [
                'required',
                'string',
                'max:14',
                Rule::unique('suppliers', 'cpf_cnpj')->ignore($this->route('supplier')),
            ],
            'type' => ['required', Rule::in(['pf', 'pj'])],
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('suppliers', 'email')->ignore($this->route('supplier')),
            ],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'number' => ['required', 'integer'],
            'complement' => ['nullable', 'string'],
            'neighborhood' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string', 'size:2'],
            'zip_code' => ['required', 'string', 'max:9'],
            'notes' => ['nullable', 'string'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'cpf_cnpj.required' => 'The CPF/CNPJ field is required.',
            'cpf_cnpj.unique' => 'The CPF/CNPJ has already been taken.',
            'cpf_cnpj.max' => 'The CPF/CNPJ must not exceed 14 characters.',
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid.',
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already been taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The phone field is required.',
            'address.required' => 'The address field is required.',
            'number.required' => 'The number field is required.',
            'number.integer' => 'The number must be an integer.',
            'neighborhood.required' => 'The neighborhood field is required.',
            'city.required' => 'The city field is required.',
            'state.required' => 'The state field is required.',
            'state.size' => 'The state must be exactly 2 characters.',
            'zip_code.required' => 'The zip code field is required.',
            'zip_code.max' => 'The zip code must not exceed 9 characters.',
            'active.boolean' => 'The active field must be true or false.',
        ];
    }
}

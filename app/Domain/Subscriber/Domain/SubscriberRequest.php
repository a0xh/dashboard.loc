<?php

namespace App\Domain\Subscriber\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class SubscriberRequest extends FormRequest
{
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
        $validation = collect([
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
            'data' => ['bail', 'nullable', 'array'],
        ]);

        switch ($this->method())
        {
            case 'POST': {
                return $validation->merge([
                    'email' => ['bail', 'required', 'email:rfc,strict,spoof', 'max:255', 'unique:subscribers,email']
                ])->toArray();
            }
            case 'PUT': {
                return $validation->merge([
                    'email' => ['bail', 'required', 'email:rfc,strict,spoof,dns', 'max:255', 'unique:subscribers,email,' . $this->subscriber->id]
                ])->toArray();
            }
            default:
                break;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [];
    }

    public function formRequest(): SubscriberDto
    {
        return new SubscriberDto(
            email: $this->email,
            status: $this->status,
            data: $this->data,
        );
    }
}

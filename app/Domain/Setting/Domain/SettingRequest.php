<?php

namespace App\Domain\Setting\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class SettingRequest extends FormRequest
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
            'key' => ['bail', 'required', 'string', 'min:3', 'max:45'],
            'data' => ['bail', 'nullable', 'array']
        ])->toArray();

        switch ($this->method())
        {
            case 'POST': {
                return $validation;
            }
            case 'PUT': {
                return $validation;
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

    public function formRequest(): SettingDto
    {
        return new SettingDto(
            key: $this->key,
            data: $this->data
        );
    }
}

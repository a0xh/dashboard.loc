<?php

namespace App\Domain\Order\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class OrderRequest extends FormRequest
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
            'status' => ['bail', 'required', 'boolean', 'in:0,1']
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

    public function formRequest(): OrderDto
    {
        return new OrderDto(
            status: $this->status
        );
    }
}

<?php

namespace App\Domain\User\Domain;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'media' => ['bail', 'nullable', 'image', 'dimensions:max_width=6000,max_height=6000'],
            'first_name' => ['bail', 'required', 'string', 'min:4', 'max:44'],
            'last_name' => ['bail', 'nullable', 'string', 'min:4', 'max:44'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
            'role_id' => ['bail', 'required', 'integer'],
            'data' => ['bail', 'nullable', 'array'],
        ]);

        switch ($this->method())
        {
            case 'POST': {
                return $validation->merge([
                    'email' => ['bail', 'required', 'email:rfc,strict,spoof', 'max:255', 'unique:users,email']
                ])->toArray();
            }
            case 'PUT': {
                return $validation->merge([
                    'email' => ['bail', 'required', 'email:rfc,strict,spoof', 'max:255', 'unique:users,email,' . $this->user->id]
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

    public function formRequest(): UserDto
    {
        return new UserDto(
            media: $this->media,
            first_name: $this->first_name,
            last_name: $this->last_name,
            email: $this->email,
            password: $this->password,
            status: $this->status,
            role_id: $this->role_id,
            data: $this->data
        );
    }
}

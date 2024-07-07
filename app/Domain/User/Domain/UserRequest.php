<?php declare(strict_types=1);

namespace App\Domain\User\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

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
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
            'last_name' => ['bail', 'nullable', 'string', 'min:4', 'max:44'],
            'role_id' => ['bail', 'required', 'string'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
            'data' => ['bail', 'nullable', 'array'],
        ]);

        $request = match ($this->method()) {
            'POST' => $validation->merge([
                'email' => ['bail', 'required', 'email:rfc,strict,spoof,dns', 'max:255', 'unique:users,email']
            ])->toArray(),
            'PUT' => $validation->merge([
                'email' => ['bail', 'required', 'email:rfc,strict,spoof,dns', 'max:255', 'unique:users,email,' . $this->user->id]
            ])->toArray(),
            'DELETE' => ['id' => ['required', 'string', 'exists:users,id,' . $this->user->id]],
        };

        return $request;
    }

    public function toDto(): UserDto
    {
        return new UserDto(
            media: $this->file('media'),
            last_name: $this->string('last_name')->trim()->value,
            email: $this->string('email')->trim()->value,
            first_name: $this->string('first_name')->trim()->value,
            password: $this->string('password')->trim()->value,
            status: $this->boolean('status'),
            role_id: $this->string('role_id')->trim()->value,
            data: $this->input('data')
        );
    }
}

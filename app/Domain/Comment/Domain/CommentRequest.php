<?php

namespace App\Domain\Comment\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class CommentRequest extends FormRequest
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
            'text' => ['bail', 'required', 'string', 'max:65535'],
            'comment_id' => ['bail', 'required', 'integer'],
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
            'type' => ['bail', 'required', 'string', 'in:product,post', 'min:4', 'max:7'],
            'product_id' => ['bail', 'nullable', 'integer'],
            'post_id' => ['bail', 'nullable', 'integer'],
        ]);

        switch ($this->method())
        {
            case 'POST': {
                return $validation->toArray();
            }
            case 'PUT': {
                return $validation->toArray();
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

    public function formRequest(): CommentDto
    {
        return new CommentDto(
            text: $this->text,
            comment_id: $this->comment_id,
            status: $this->status,
            product_id: $this->product_id,
            post_id: $this->post_id,
            type: $this->type,
        );
    }
}

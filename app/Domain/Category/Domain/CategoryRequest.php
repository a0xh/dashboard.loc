<?php

namespace App\Domain\Category\Domain;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Category\Domain\CategoryDto;

class CategoryRequest extends FormRequest
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
            'title' => ['bail', 'required', 'string', 'min:3', 'max:65'],
            'description' => ['bail', 'nullable', 'string', 'min:3', 'max:200'],
            'media' => ['bail', 'nullable', 'image', 'dimensions:max_width=6000,max_height=6000'],
            'keywords' => ['bail', 'nullable', 'string', 'min:3', 'max:200'],
            'category_id' => ['bail', 'nullable', 'integer'],
            'type' => ['bail', 'nullable', 'string', 'in:product,post', 'min:4', 'max:7'],
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
        ]);

        switch ($this->method())
        {
            case 'POST': {
                return $validation->merge([
                    'slug' => ['bail', 'nullable', 'string', 'lowercase', 'min:1', 'max:65', 'unique:categories,slug']
                ])->toArray();
            }
            case 'PUT': {
                return $validation->merge([
                    'slug' => ['bail', 'nullable', 'string', 'lowercase', 'min:1', 'max:65', 'unique:categories,slug,' . $this->category->id]
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

    public function formRequest(): CategoryDto
    {
        return new CategoryDto(
            title: $this->title,
            category_id: $this->category_id,
            slug: $this->slug,
            keywords: $this->keywords,
            description: $this->description,
            media: $this->media,
            status: $this->status,
            type: $this->type,
        );
    }
}

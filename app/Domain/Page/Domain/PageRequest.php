<?php

namespace App\Domain\Page\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class PageRequest extends FormRequest
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
            'keywords' => ['bail', 'nullable', 'string', 'min:3', 'max:200'],
            'media' => ['bail', 'nullable', 'image', 'dimensions:max_width=6000,max_height=6000'],
            'category_id' => ['bail', 'nullable', 'integer'],
            'text' => ['bail', 'nullable', 'string', 'max:65535'],
            'tag_id' => ['bail', 'nullable', 'array'],
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
            'data' => ['bail', 'nullable', 'array'],
        ]);

        switch ($this->method())
        {
            case 'POST': {
                return $validation->merge([
                    'slug' => ['bail', 'nullable', 'string', 'lowercase', 'min:1', 'max:65', 'unique:pages,slug']
                ])->toArray();
            }
            case 'PUT': {
                return $validation->merge([
                    'slug' => ['bail', 'nullable', 'string', 'lowercase', 'min:1', 'max:65', 'unique:pages,slug,' . $this->page->id]
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

    public function formRequest(): PageDto
    {
        return new PageDto(
            title: $this->title,
            description: $this->description,
            slug: $this->slug,
            keywords: $this->keywords,
            media: $this->media,
            text: $this->text,
            status: $this->status,
            data: $this->data,
        );
    }
}

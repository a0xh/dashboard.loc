<?php

namespace App\Domain\Post\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class PostRequest extends FormRequest
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
            'status' => ['bail', 'required', 'boolean', 'in:0,1'],
            'content' => ['bail', 'nullable', 'string', 'max:65535'],
            'category_id' => ['bail', 'nullable', 'integer'],
            'tag_id' => ['bail', 'nullable', 'array'],
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
                    'slug' => ['bail', 'nullable', 'string', 'lowercase', 'min:1', 'max:65', 'unique:posts,slug,' . $this->post->id]
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

    public function formRequest(): PostDto
    {
        return new PostDto(
            title: $this->title,
            category_id: $this->category_id,
            slug: $this->slug,
            keywords: $this->keywords,
            description: $this->description,
            media: $this->media,
            content: $this->content,
            status: $this->status,
            tag_id: $this->tag_id,
        );
    }
}

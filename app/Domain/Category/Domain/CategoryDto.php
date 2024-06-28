<?php

namespace App\Domain\Category\Domain;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class CategoryDto
{
    public function __construct(
        private string $title,
        private string $slug,
        private ?string $description,
        private ?string $keywords,
        private bool $status,
        private ?UploadedFile $media,
        private ?int $category_id,
        private ?array $data
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMedia(): ?UploadedFile
    {
        return $this->media;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}

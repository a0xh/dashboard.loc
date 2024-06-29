<?php

namespace App\Domain\Tag\Domain;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class TagDto
{
    public function __construct(
        private string $title,
        private ?string $description,
        private ?string $slug,
        private ?string $keywords,
        private bool $status,
        private ?UploadedFile $media,
        private string $type
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): ?string
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

    public function getType(): string
    {
        return $this->type;
    }
}

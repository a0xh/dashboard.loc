<?php

namespace App\Domain\Comment\Domain;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class CommentDto
{
    public function __construct(
        private string $text,
        private int $comment_id,
        private bool $status,
        private string $type,
        private ?int $product_id,
        private ?int $post_id,
    ) {}

    public function getContent(): string
    {
        return $this->text;
    }

    public function getCommentId(): int
    {
        return $this->comment_id;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getType(): bool
    {
        return $this->type;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }
}

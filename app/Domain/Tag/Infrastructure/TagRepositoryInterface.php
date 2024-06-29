<?php declare(strict_types=1);

namespace App\Domain\Tag\Infrastructure;

use App\Domain\Tag\Domain\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

interface TagRepositoryInterface
{
    public function getTagAll(string $type): array;
    public function getTagByProduct(int $count): LengthAwarePaginator;
    public function getTagByPost(int $count): LengthAwarePaginator;
    public function createTag(array $data): bool;
    public function updateTag(Tag $tag, array $data): bool;
    public function deleteTag(Tag $tag): bool;
}

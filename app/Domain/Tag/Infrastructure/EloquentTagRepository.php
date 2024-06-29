<?php declare(strict_types=1);

namespace App\Domain\Tag\Infrastructure;

use App\Domain\Tag\Domain\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentTagRepository extends DecoratorTagRepository
{
    public function __construct(protected Tag $tag) {}

    public function getTagAll(string $type): array
    {
        return $this->tag->where('type', $type)->orderBy('created_at', 'desc')->get()->all();
    }

    public function getTagByProduct(int $count): LengthAwarePaginator
    {
        return = $this->tag->query()->with('user')->where('type', 'product')->orderByDesc('created_at')->paginate($count);
    }

    public function getTagByPost(int $count): LengthAwarePaginator
    {
        return $this->tag->query()->with('user')->where('type', 'post')->orderByDesc('created_at')->paginate($count);
    }

    public function createTag(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $this->tag->create($data);
            }, 3);

            return $this->tag->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateTag(Tag $tag, array $data): bool
    {
        try {
            DB::transaction(function() use($tag, $data) {
                $tag->update($data);
            }, 3);

            return $tag->wasChanged();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deleteTag(Tag $tag): bool
    {
        try {
            DB::transaction(function() use($tag) {
                $tag->delete();
            }, 3);

            if ($tag->deleteOrFail() !== true) {
                return true;
            } else {
                return false;
            }
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}

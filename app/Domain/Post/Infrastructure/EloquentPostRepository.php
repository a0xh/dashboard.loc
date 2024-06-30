<?php declare(strict_types=1);

namespace App\Domain\Post\Infrastructure;

use App\Domain\Post\Domain\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentPostRepository extends DecoratorPostRepository
{
    public function __construct(protected Post $post) {}

    public function getPost(int $count): LengthAwarePaginator
    {
        return $this->post->query()->with(['user', 'category', 'tags'])->orderByDesc('created_at')->paginate($count);
    }

    public function createPost(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $tagId = $data['tag_id'];

                $post = $this->post->create(data_forget($data, 'tag_id'));
                $post->tags()->sync($tagId);
            }, 3);

            return $this->post->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updatePost(Post $post, array $data): bool
    {
        try {
            DB::transaction(function() use($post, $data) {
                $tagId = $data['tag_id'];

                $post->update(data_forget($data, 'tag_id'));
                $post->tags()->sync($tagId);
            }, 3);

            return $post->wasChanged();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deletePost(Post $post): bool
    {
        try {
            DB::transaction(function() use($post) {
                $post->tags()->detach();
                $post->delete();
            }, 3);

            if ($post->deleteOrFail() !== true) {
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

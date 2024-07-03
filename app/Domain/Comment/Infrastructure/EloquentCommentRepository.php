<?php declare(strict_types=1);

namespace App\Domain\Comment\Infrastructure;

use App\Domain\Comment\Domain\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentCommentRepository extends DecoratorCommentRepository
{
    public function __construct(protected Comment $comment) {}

    public function getCommentByProduct(int $count): LengthAwarePaginator
    {
        $comments = $this->comment->query()->where('type', 'product')->whereNull('comment_id');
        
        $data = ['childrenComments', 'user', 'products'];

        return $comments->with($data)->orderByDesc('created_at')->distinct()->paginate($count);
    }

    public function getCommentByPost(int $count): LengthAwarePaginator
    {
        $comments = $this->comment->query()->where('type', 'post')->whereNull('comment_id');

        $data = ['childrenComments', 'user', 'posts'];

        return $comments->with($data)->orderByDesc('created_at')->distinct()->paginate($count);
    }

    public function createComment(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $getType = $data['type'];

                $setType = match ($getType) {
                    'product' => 'product_id',
                    'post' => 'post_id',
                };

                $comment = $this->comment->create(data_forget($data, $setType));
                $comment->products()->sync([$setType]);
            }, 3);

            return $this->comment->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateComment(Comment $comment, array $data): bool
    {
        try {
            DB::transaction(function() use($comment, $data) {
                $type = $comment->type;

                switch ($type) {
                    case 'product':
                        $comment->update(data_forget($data, 'product_id'));

                        foreach ($comment->products as $product) {
                            $comment->products()->sync([$product->id]);
                        }
                        break;
                    case 'post':
                        $comment->update(data_forget($data, 'post_id'));
                        
                        foreach ($comment->posts as $post) {
                            $comment->products()->sync([$post->id]);
                        }
                        break;
                    
                    default:
                        break;
                }
            }, 3);

            return $comment->wasChanged();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deleteComment(Comment $comment): bool
    {
        try {
            DB::transaction(function() use($comment) {
                $type = $comment->type;

                switch ($type) {
                    case 'product':
                        $comment->products()->detach();
                        break;
                    case 'post':
                        $comment->posts()->detach();
                        break;
                    
                    default:
                        break;
                }
                
                $comment->delete();
            }, 3);

            if ($comment->deleteOrFail() !== true) {
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

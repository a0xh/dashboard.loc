<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Comment\Infrastructure\CommentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Comment\Domain\{Comment, CommentRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;

final class StoreCommentAction extends Controller
{
    public function __construct(
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly StoreCommentResponder $commentResponder
    ) {}

    #[Post('/admin/comment/store', name: "admin.comment.store")]
    public function __invoke(CommentRequest $commentRequest): RedirectResponse
    {
        $commentDto = literal($commentRequest->formRequest());

        $data = collect([
            'content' => $commentDto->getContent(),
            'comment_id' => $commentDto->getCommentId(),
            'type' => $commentDto->getType(),
            'product_id' => $commentDto->getProductId(),
            'post_id' => $commentDto->getPostId(),
        ]);

        $createComment = $this->commentRepository->createComment($data->merge([
            'status' => true, 'user_id' => Auth::user()->id
        ])->toArray());

        $redirectTo = $this->commentResponder->handle($createComment);

        return $redirectTo;
    }
}

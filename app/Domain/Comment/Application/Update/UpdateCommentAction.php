<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Comment\Infrastructure\CommentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Facades\Auth;
use App\Domain\Comment\Domain\{Comment, CommentRequest};
use Illuminate\Support\Collection;

#[Where('{comment:id}', '[0-9]+')]
final class UpdateCommentAction extends Controller
{
    public function __construct(
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly UpdateCommentResponder $commentResponder
    ) {}

    #[Put('/admin/comment/{comment:id}/update', name: "admin.comment.update")]
    public function __invoke(Comment $comment, CommentRequest $commentRequest): RedirectResponse
    {
        $commentDto = literal($commentRequest->formRequest());

        $data = collect([
            'content' => $commentDto->getContent(),
            'status' => $commentDto->getStatus(),
            'product_id' => $commentDto->getProductId(),
            'post_id' => $commentDto->getPostId()
        ]);

        $updateComment = $this->commentRepository->updateComment($comment, 
            $data->merge([
                'user_id' => $comment->user_id,
                'comment_id' => $comment->comment_id ?? null,
                'type' => $comment->type,
            ])->toArray()
        );

        $redirectTo = $this->commentResponder->handle($updateComment);

        return $redirectTo;
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Comment\Infrastructure\CommentRepositoryInterface;
use App\Domain\Comment\Domain\Comment;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use Illuminate\Http\RedirectResponse;

#[Where('{comment:id}', '[0-9]+')]
final class DeleteCommentAction extends Controller
{
    public function __construct(
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly DeleteCommentResponder $commentResponder
    ) {}

    #[Delete('/admin/comment/{comment:id}/delete', name: "admin.comment.delete")]
    public function __invoke(Comment $comment): RedirectResponse
    {
        $deleteComment = $this->commentRepository->deleteComment($comment);
        $redirectTo = $this->commentResponder->handle($deleteComment);

        return $redirectTo;
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Comment\Infrastructure\CommentRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexCommentAction extends Controller
{
    public function __construct(
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly IndexCommentResponder $commentResponder
    ) {}

    #[Get('/admin/comment', name: 'admin.comment.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->commentResponder->handle([
            'commentsTypeProduct' => $this->commentRepository->getCommentByProduct(11),
            'commentsTypePost' => $this->commentRepository->getCommentByPost(11)
        ]);
    }
}

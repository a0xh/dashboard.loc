<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexCommentResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::comment.index', $data);
    }
}

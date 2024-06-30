<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexPostResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::post.index', $data);
    }
}

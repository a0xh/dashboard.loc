<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexTagResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::tag.index', $data);
    }
}

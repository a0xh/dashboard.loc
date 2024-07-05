<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexPageResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::page.index', $data);
    }
}

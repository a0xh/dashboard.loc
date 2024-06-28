<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexCategoryResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::category.index', $data);
    }
}

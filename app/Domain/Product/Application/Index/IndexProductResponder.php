<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexProductResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::product.index', $data);
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Order\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexOrderResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::order.index', $data);
    }
}

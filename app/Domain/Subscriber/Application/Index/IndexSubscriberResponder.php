<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexSubscriberResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::subscriber.index', $data);
    }
}

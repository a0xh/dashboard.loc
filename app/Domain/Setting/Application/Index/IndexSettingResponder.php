<?php declare(strict_types=1);

namespace App\Domain\Setting\Application\Index;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

final readonly class IndexSettingResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::setting.index', $data);
    }
}

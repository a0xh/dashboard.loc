<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Create;

use Illuminate\Support\Facades\View;

final readonly class CreateCategoryResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::category.create', $data);
    }
}

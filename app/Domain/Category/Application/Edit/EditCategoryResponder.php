<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditCategoryResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::category.edit', $data);
    }
}

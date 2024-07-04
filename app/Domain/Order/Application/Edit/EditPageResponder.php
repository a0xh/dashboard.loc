<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditPageResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::page.edit', $data);
    }
}

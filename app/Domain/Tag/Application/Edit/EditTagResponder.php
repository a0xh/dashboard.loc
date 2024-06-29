<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditTagResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::tag.edit', $data);
    }
}

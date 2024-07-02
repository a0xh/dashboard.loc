<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditPostResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::post.edit', $data);
    }
}

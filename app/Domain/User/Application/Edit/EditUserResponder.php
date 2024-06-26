<?php declare(strict_types=1);

namespace App\Domain\User\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditUserResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::user.edit', $data);
    }
}

<?php declare(strict_types=1);

namespace App\Domain\User\Application\Create;

use Illuminate\Support\Facades\View;

final readonly class CreateUserResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::user.create', $data);
    }
}

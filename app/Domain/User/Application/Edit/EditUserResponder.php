<?php declare(strict_types=1);

namespace App\Domain\User\Application\Edit;

use App\Domain\User\Domain\User;
use Illuminate\Support\Facades\View;

final readonly class EditUserResponder
{
    public function handle(User $user, array $roles): \Illuminate\View\View
    {
        return View::make('admin::user.edit', compact('user', 'roles'));
    }
}

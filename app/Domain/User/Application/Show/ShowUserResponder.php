<?php declare(strict_types=1);

namespace App\Domain\User\Application\Show;

use App\Domain\User\Domain\User;
use Illuminate\Support\Facades\View;

final readonly class ShowUserResponder
{
    public function handle(User $user): \Illuminate\View\View
    {
        return View::make('admin::user.show')->with(['user' => $user]);
    }
}

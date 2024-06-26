<?php declare(strict_types=1);

namespace App\Domain\User\Application\Show;

use Illuminate\Support\Facades\View;

final readonly class ShowUserResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::user.show')->with($data);
    }
}

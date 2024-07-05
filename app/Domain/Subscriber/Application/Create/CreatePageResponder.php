<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Create;

use Illuminate\Support\Facades\View;

final readonly class CreatePageResponder
{
    public function handle(): \Illuminate\View\View
    {
        return View::make('admin::page.create');
    }
}

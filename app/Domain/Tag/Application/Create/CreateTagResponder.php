<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Create;

use Illuminate\Support\Facades\View;

final readonly class CreateTagResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::tag.create', $data);
    }
}

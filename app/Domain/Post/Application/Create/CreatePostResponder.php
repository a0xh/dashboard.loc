<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Create;

use Illuminate\Support\Facades\View;

final readonly class CreatePostResponder
{
    public function handle(): \Illuminate\View\View
    {
        return View::make('admin::post.create');
    }
}

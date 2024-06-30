<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditProductResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::product.edit', $data);
    }
}

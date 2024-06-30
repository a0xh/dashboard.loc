<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Create;

use Illuminate\Support\Facades\View;

final readonly class CreateProductResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        return View::make('admin::product.create', $data);
    }
}

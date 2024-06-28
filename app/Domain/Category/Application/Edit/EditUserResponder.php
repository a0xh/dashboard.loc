<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Edit;

use Illuminate\Support\Facades\View;

final readonly class EditCategoryResponder
{
    public function handle(array $data): \Illuminate\View\View
    {
        $query = request()->query('type', null);

        if (isset($query))
        {
            switch ($query) {
                case 'product':
                    return View::make('admin::category.edit', $data['categoriesTypeProduct']);
                    break;
                case 'post':
                    return View::make('admin::category.edit', $data['categoriesTypePost']);
                    break;
                
                default:
                    abort(404);
            }
        }

        abort(404);
    }
}

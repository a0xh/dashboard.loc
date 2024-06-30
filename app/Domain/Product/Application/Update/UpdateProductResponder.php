<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateProductResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.product.update.success');
            return redirect()->route('admin.product.index');
        }

        return back()->with('error', 'messages.product.update.error');
    }
}

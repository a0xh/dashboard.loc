<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StoreProductResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.product.store.success');
            return redirect()->route('admin.product.index');
        }

        return back()->with('error', 'messages.product.store.error');
    }
}

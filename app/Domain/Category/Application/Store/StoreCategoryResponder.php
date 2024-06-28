<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StoreCategoryResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.category.store.success');
            return redirect()->route('admin.category.index');
        }

        return back()->with('error', 'messages.category.store.error');
    }
}

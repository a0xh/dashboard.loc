<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StorePageResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.page.store.success');
            return redirect()->route('admin.page.index');
        }

        return back()->with('error', 'messages.page.store.error');
    }
}

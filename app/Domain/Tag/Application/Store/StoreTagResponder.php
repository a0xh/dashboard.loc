<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StoreTagResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.tag.store.success');
            return redirect()->route('admin.tag.index');
        }

        return back()->with('error', 'messages.tag.store.error');
    }
}

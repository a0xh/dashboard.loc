<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StorePostResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.post.store.success');
            return redirect()->route('admin.post.index');
        }

        return back()->with('error', 'messages.post.store.error');
    }
}

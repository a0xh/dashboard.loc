<?php declare(strict_types=1);

namespace App\Domain\User\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StoreUserResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.user.store.success');
            return redirect()->route('admin.user.index');
        }

        return back()->with('error', 'messages.user.store.error');
    }
}

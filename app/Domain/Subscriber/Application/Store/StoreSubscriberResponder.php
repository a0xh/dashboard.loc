<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StoreSubscriberResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.subscriber.store.success');
            return redirect()->route('admin.subscriber.index');
        }

        return back()->with('error', 'messages.subscriber.store.error');
    }
}

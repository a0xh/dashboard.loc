<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateSubscriberResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.subscriber.update.success');
            return redirect()->route('admin.subscriber.index');
        }

        return back()->with('error', 'messages.subscriber.update.error');
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteSubscriberResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.subscriber.delete.success');
            return redirect()->route('admin.subscriber.index');
        }
        
        return back()->with('error', 'messages.subscriber.delete.error');
    }
}

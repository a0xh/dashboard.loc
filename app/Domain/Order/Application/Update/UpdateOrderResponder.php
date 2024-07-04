<?php declare(strict_types=1);

namespace App\Domain\Order\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateOrderResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.order.update.success');
            return redirect()->route('admin.order.index');
        }

        return back()->with('error', 'messages.order.update.error');
    }
}

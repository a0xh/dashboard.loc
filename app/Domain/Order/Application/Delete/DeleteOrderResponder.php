<?php declare(strict_types=1);

namespace App\Domain\Order\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteOrderResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.order.delete.success');
            return redirect()->route('admin.order.index');
        }
        
        return back()->with('error', 'messages.order.delete.error');
    }
}

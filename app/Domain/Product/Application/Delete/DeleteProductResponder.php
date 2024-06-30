<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteProductResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.product.delete.success');
            return redirect()->route('admin.product.index');
        }
        
        return back()->with('error', 'messages.product.delete.error');
    }
}

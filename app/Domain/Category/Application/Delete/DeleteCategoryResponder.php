<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteCategoryResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.category.delete.success');
            return redirect()->route('admin.category.index');
        }
        
        return back()->with('error', 'messages.category.delete.error');
    }
}

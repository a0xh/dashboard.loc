<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateCategoryResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.category.update.success');
            return redirect()->route('admin.category.index');
        }

        return back()->with('error', 'messages.category.update.error');
    }
}

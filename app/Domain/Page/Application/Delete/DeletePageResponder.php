<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeletePageResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.page.delete.success');
            return redirect()->route('admin.page.index');
        }
        
        return back()->with('error', 'messages.page.delete.error');
    }
}

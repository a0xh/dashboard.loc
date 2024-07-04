<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdatePageResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.page.update.success');
            return redirect()->route('admin.page.index');
        }

        return back()->with('error', 'messages.page.update.error');
    }
}

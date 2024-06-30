<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdatePostResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.post.update.success');
            return redirect()->route('admin.post.index');
        }

        return back()->with('error', 'messages.post.update.error');
    }
}

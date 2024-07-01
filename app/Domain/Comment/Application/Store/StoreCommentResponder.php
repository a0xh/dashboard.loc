<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Store;

use Illuminate\Http\RedirectResponse;

final readonly class StoreCommentResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.comment.store.success');
            return redirect()->route('admin.comment.index');
        }

        return back()->with('error', 'messages.comment.store.error');
    }
}

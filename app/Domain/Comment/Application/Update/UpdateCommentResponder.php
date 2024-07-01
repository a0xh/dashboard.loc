<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateCommentResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.comment.update.success');
            return redirect()->route('admin.comment.index');
        }

        return back()->with('error', 'messages.comment.update.error');
    }
}

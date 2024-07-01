<?php declare(strict_types=1);

namespace App\Domain\Comment\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteCommentResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.comment.delete.success');
            return redirect()->route('admin.comment.index');
        }
        
        return back()->with('error', 'messages.comment.delete.error');
    }
}

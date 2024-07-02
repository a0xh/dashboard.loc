<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeletePostResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.post.delete.success');
            return redirect()->route('admin.post.index');
        }
        
        return back()->with('error', 'messages.post.delete.error');
    }
}

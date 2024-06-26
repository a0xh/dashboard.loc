<?php declare(strict_types=1);

namespace App\Domain\User\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteUserResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.user.update.success');
            return redirect()->route('admin.user.index');
        }
        
        return back()->with('error', 'messages.user.update.error');
    }
}

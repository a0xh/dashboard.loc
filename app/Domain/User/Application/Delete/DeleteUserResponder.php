<?php declare(strict_types=1);

namespace App\Domain\User\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteUserResponder
{
    public function handle(bool $result): RedirectResponse
    {
        $message = 'messages.admin.user.delete';

        if ($result) {
            session()->flash("success", "{$message}.success");
            return redirect()->route('admin.user.index');
        }
        
        return back()->with("error", "{$message}.error");
    }
}

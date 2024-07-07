<?php declare(strict_types=1);

namespace App\Domain\User\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateUserResponder
{
    public function handle(bool $result): RedirectResponse
    {
        $message = 'messages.admin.user.update';
        
        if ($result) {
            session()->flash("success", "{$message}.success");
            return redirect()->route('admin.user.index');
        }

        return back()->with("error", "{$message}.error");
    }
}

<?php declare(strict_types=1);

namespace App\Domain\User\Application\Update;

use App\Domain\User\Application\Index\UserIndexAction;
use Illuminate\Http\RedirectResponse;

final readonly class UpdateUserResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.user.update.success');
            return redirect()->action(UserIndexAction::class);
        }

        return back()->with('error', 'messages.user.update.error');
    }
}

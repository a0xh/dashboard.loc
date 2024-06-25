<?php declare(strict_types=1);

namespace App\Domain\User\Application\Delete;

use App\Domain\User\Application\Index\IndexUserAction;
use Illuminate\Http\RedirectResponse;

final readonly class DeleteUserResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.user.update.success');
            return redirect()->action(IndexUserAction::class);
        }
        
        return back()->with('error', 'messages.user.update.error');
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateTagResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.tag.update.success');
            return redirect()->route('admin.tag.index');
        }

        return back()->with('error', 'messages.tag.update.error');
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Delete;

use Illuminate\Http\RedirectResponse;

final readonly class DeleteTagResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.tag.delete.success');
            return redirect()->route('admin.tag.index');
        }
        
        return back()->with('error', 'messages.tag.delete.error');
    }
}

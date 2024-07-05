<?php declare(strict_types=1);

namespace App\Domain\Setting\Application\Update;

use Illuminate\Http\RedirectResponse;

final readonly class UpdateSettingResponder
{
    public function handle(bool $result): RedirectResponse
    {
        if ($result) {
            session()->flash('success', 'messages.setting.update.success');
            return redirect()->route('admin.setting.index');
        }

        return back()->with('error', 'messages.setting.update.error');
    }
}

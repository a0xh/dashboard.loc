<?php declare(strict_types=1);

namespace App\Domain\Setting\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Setting\Infrastructure\SettingRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Setting\Domain\{Setting, SettingRequest};
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;

#[Where('{setting:id}', '[0-9]+')]
final class UpdateSettingAction extends Controller
{
    public function __construct(
        private readonly SettingRepositoryInterface $settingRepository,
        private readonly UpdateSettingResponder $settingResponder
    ) {}

    #[Put('/admin/setting/{setting:id}/update', name: "admin.setting.update")]
    public function __invoke(Setting $setting, SettingRequest $settingRequest): RedirectResponse
    {
        $settingDto = literal($settingRequest->formRequest());

        $data = collect(['data' => $settingDto->getData()])->merge(['key' => $setting->key]);

        $updateSetting = $this->settingRepository->updateSetting($setting, $data->toArray());
        $redirectTo = $this->settingResponder->handle($updateSetting);

        return $redirectTo;
    }
}

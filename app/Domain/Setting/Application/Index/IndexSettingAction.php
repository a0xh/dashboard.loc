<?php declare(strict_types=1);

namespace App\Domain\Setting\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Setting\Infrastructure\SettingRepositoryInterface;
use App\Domain\Setting\Domain\Setting;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexSettingAction extends Controller
{
    public function __construct(
        private readonly SettingRepositoryInterface $settingRepository,
        private readonly IndexSettingResponder $settingResponder
    ) {}

    #[Get('/admin/setting', name: 'admin.setting.index')]
    public function __invoke(): \Illuminate\View\View
    {
        $database = $this->settingRepository->getSettingByFind('database');
        $default = $this->settingRepository->getSettingByFind('default');

        return $this->settingResponder->handle([
            'database' => $database,
            'default' => $default
        ]);
    }
}

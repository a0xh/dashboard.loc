<?php declare(strict_types=1);

namespace App\Domain\Setting\Infrastructure;

use App\Domain\Setting\Domain\Setting;

interface SettingRepositoryInterface
{
    public function getSettingByFind(string $key): Setting;
    public function updateSetting(Setting $setting, array $data): bool;
}

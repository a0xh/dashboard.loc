<?php declare(strict_types=1);

namespace App\Domain\Setting\Infrastructure;

use App\Domain\Setting\Domain\Setting;
use Illuminate\Support\Facades\DB;

class EloquentSettingRepository extends DecoratorSettingRepository
{
    public function __construct(protected Setting $setting) {}

    public function getSettingByFind(string $key): Setting
    {
        return $this->setting->query()->where('key', $key)->first();
    }

    public function updateSetting(Setting $setting, array $data): bool
    {
        try {
            DB::transaction(function() use($setting, $data) {
                $setting->update($data);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}

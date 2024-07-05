<?php declare(strict_types=1);

namespace App\Domain\Setting\Infrastructure;

use App\Domain\Setting\Domain\Setting;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedSettingRepository implements SettingRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentSettingRepository $settingRepository,
        public CacheManager $cache
    ) {}

    public function getSettingByFind(string $key): Setting
    {
        $getSetting = $this->cache->remember('settings', self::TTL, function() use($key) {
            return $this->settingRepository->getSetting($key);
        });

        return $getSetting;
    }

    public function updateSetting(Setting $setting, array $data): bool
    {
        $updateSetting = $this->settingRepository->updateSetting($setting, $data);

        $cache = $this->cache;

        collect(['settings'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateSetting;
    }
}

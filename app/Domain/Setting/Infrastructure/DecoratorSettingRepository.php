<?php declare(strict_types=1);

namespace App\Domain\Setting\Infrastructure;

abstract class DecoratorSettingRepository implements SettingRepositoryInterface
{
    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Setting\Domain\Setting;


class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Setting();
        $setting->key = 'default';
        $setting->data = [
            'name' => 'Site Name',
            'environment' => 'local',
            'debug' => 'true',
            'timezone' => 'Asia/Yekaterinburg',
            'url' => 'http://site.loc',
            'locale' => 'ru'
        ];
        $setting->save();

        $setting = new Setting();
        $setting->key = 'database';
        $setting->data = [
            'host' => '127.0.0.1',
            'port' => '3306',
            'name' => 'dbname',
            'user' => 'dbuser',
            'pass' => 'dbpass'
        ];
        $setting->save();
    }
}

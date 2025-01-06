<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingService
{
    public function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return SiteSetting::pluck('value', 'key')->toArray(); // ['key' => 'value']
        });
    }

    public function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    public function clearCacheSettings(): void
    {
        Cache::forget('settings');
    }
}

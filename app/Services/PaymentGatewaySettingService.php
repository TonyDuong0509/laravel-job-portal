<?php

namespace App\Services;

use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Cache;

class PaymentGatewaySettingService
{

    public function getSettings()
    {
        return Cache::rememberForever('gatewaySettings', function () {
            return PaymentSetting::pluck('value', 'key')->toArray(); // ['key' => 'value']
        });
    }

    public function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('gatewaySettings', $settings);
    }

    public function clearCacheSettings(): void
    {
        Cache::forget('gatewaySettings');
    }
}

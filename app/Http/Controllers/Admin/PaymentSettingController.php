<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Http\Requests\Admin\RazorpaySettingUpdateRequest;
use App\Http\Requests\Admin\StripeSettingUpdateRequest;
use App\Models\PaymentSetting;
use App\Services\Notify;
use App\Services\PaymentGatewaySettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentSettingController extends Controller
{
    public function index(): View
    {
        return view('admin.payment-setting.index');
    }

    public function updatePaypalSetting(PaypalSettingUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        foreach ($validated as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(PaymentGatewaySettingService::class);
        $settingsService->clearCacheSettings();

        Notify::updatedNotification();
        return redirect()->back();
    }

    public function updateStripeSetting(StripeSettingUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        foreach ($validated as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCacheSettings();

        Notify::updatedNotification();
        return redirect()->back();
    }

    public function updateRazorpaySetting(RazorpaySettingUpdateRequest $request)
    {
        $validated = $request->validated();
        foreach ($validated as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCacheSettings();

        Notify::updatedNotification();
        return redirect()->back();
    }
}

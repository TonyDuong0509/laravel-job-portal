<?php

namespace App\Helpers;

// Check input error
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

if (!function_exists('hasError')) {
    function hasError($errors, string $name): string
    {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}

// Set admin sidebar active
if (!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes): ?string
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return null;
    }
}

/** Check profile completion */
if (!function_exists('isCompanyProfileComplete')) {
    function isCompanyProfileComplete(): bool
    {
        $requiredFields = [
            'logo', 'banner', 'bio', 'vision', 'name', 'industry_type_id',
            'organization_type_id', 'team_size_id', 'establishment_date', 'phone', 'email', 'country'
        ];
        $companyProfile = Company::where('user_id', Auth::user()->id)->first();

        foreach ($requiredFields as $field) {
            if (empty($companyProfile->{$field})) {
                return false;
            }
        }
        return true;
    }
}

<?php

namespace App\Helpers;

// Check input error

use App\Models\Candidate;
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
            'logo',
            'banner',
            'bio',
            'vision',
            'name',
            'industry_type_id',
            'organization_type_id',
            'team_size_id',
            'establishment_date',
            'phone',
            'email',
            'country'
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

if (!function_exists('isCandidateProfileComplete')) {
    function isCandidateProfileComplete(): bool
    {
        $requiredFields = [
            'experience_id',
            'profession_id',
            'image',
            'full_name',
            'birth_date',
            'gender',
            'bio',
            'marital_status',
            'country',
            'status',
        ];
        $CandidateProfile = Candidate::where('user_id', Auth::user()->id)->first();

        foreach ($requiredFields as $field) {
            if (empty($CandidateProfile->{$field})) {
                return false;
            }
        }
        return true;
    }
}

// Store plan info in session
if (!function_exists('storePlanInformation')) {
    function storePlanInformation()
    {
        session()->forget('user_plan');
        session([
            'user_plan' => isset(auth()->user()?->company->userPlan) ? auth()->user()?->company->userPlan : [],
        ]);
    };
}

//  Format location
if (!function_exists('formatLocation')) {
    function formatLocation($country = null, $state = null, $city = null, $address = null): string
    {
        $location = '';
        if ($address) {
            $location .= $address;
        }
        if ($city) {
            $location .= $address ? ', ' . $city : $city;
        }
        if ($state) {
            $location .= $city ? ', ' . $state : $state;
        }
        if ($country) {
            $location .= $state ? ', ' . $country : $country;
        }

        return $location;
    };
}

if (!function_exists('calculateEarnings')) {
    function calculateEarnings($amounts): string
    {
        $total = 0;
        foreach ($amounts as $value) {
            $amount = intval(preg_replace('/[^0-9]/', '', $value));
            $total += $amount;
        }

        return $total;
    }
};

<?php

namespace App\Http\Requests\Frontend;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCompanyInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'logo' => ['image', 'max:1500'],
            'banner' => ['image', 'max:1500'],
            'name' => ['required', 'string', 'max:100'],
            'bio' => ['required'],
            'vision' => ['required'],
        ];

        $comapny = Company::where('user_id', Auth::user()->id)->first();
        if (empty($comapny) || !$comapny?->logo) $rules['logo'][] = 'required';
        if (empty($comapny) || !$comapny?->banner) $rules['banner'][] = 'required';

        return $rules;
    }
}

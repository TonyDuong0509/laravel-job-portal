<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateCompanyFoundingInfoRequest;
use App\Http\Requests\Frontend\UpdateCompanyInfoRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\IndustryType;
use App\Models\OrganizationType;
use App\Models\State;
use App\Models\TeamSize;
use App\Models\User;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use function App\Helpers\isCompanyProfileComplete;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        $companyInfo = Company::where('user_id', Auth::id())->first();
        $industryTypes = IndustryType::all();
        $organizationTypes = OrganizationType::all();
        $teamSizes = TeamSize::all();
        $countries = Country::all();
        $states = State::select(['id', 'name', 'country_id'])->where('country_id', $companyInfo?->country)->get();
        $cities = City::select(['id', 'name', 'country_id', 'state_id'])->where('state_id', $companyInfo?->state)->get();

        return view('frontend.company-dashboard.profile.index', compact(
            'companyInfo',
            'industryTypes',
            'organizationTypes',
            'teamSizes',
            'countries',
            'states',
            'cities'
        ));
    }

    public function updateCompanyInfo(UpdateCompanyInfoRequest $request): RedirectResponse
    {
        $logoPath = $this->uploadFile($request, 'logo');
        $bannerPath = $this->uploadFile($request, 'banner');

        $data = [];
        if (!empty($logoPath)) $data['logo'] = $logoPath;
        if (!empty($bannerPath)) $data['banner'] = $bannerPath;
        $data['name'] = $request->name;
        $data['slug'] = str_replace(' ', '-', strtolower($request->name));
        $data['bio'] = $request->bio;
        $data['vision'] = $request->vision;

        Company::updateOrCreate([
            'user_id' => Auth::user()->id
        ], $data);

        Notify::createdNotification();

        if (isCompanyProfileComplete()) {
            $companyProfile = Company::where('user_id', Auth::user()->id)->first();
            $companyProfile->profile_completion = 1;
            $companyProfile->visibility = 1;
            $companyProfile->save();
        }

        return redirect()->back();
    }

    public function updateFoundingInfo(UpdateCompanyFoundingInfoRequest $request): RedirectResponse
    {
        Company::updateOrCreate(
            ['user_id' => Auth::user()->id],
            [
                'industry_type_id' => $request->industry_type_id,
                'organization_type_id' => $request->organization_type_id,
                'team_size_id' => $request->team_size_id,
                'establishment_date' => $request->establishment_date,
                'website' => $request->website,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'map_link' => $request->map_link,
            ]
        );

        if (isCompanyProfileComplete()) {
            $companyProfile = Company::where('user_id', Auth::user()->id)->first();
            $companyProfile->profile_completion = 1;
            $companyProfile->visibility = 1;
            $companyProfile->save();
        }

        Notify::updatedNotification();

        return redirect()->back();
    }

    public function updateAccountInfo(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email']
        ]);
        $user = Auth::user()->id;
        $user = User::findOrFail($user);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        Notify::updatedNotification();

        return redirect()->back();
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = Auth::user()->id;
        $user = User::findOrFail($user);
        $user->password = bcrypt($request->password);
        $user->save();

        Notify::updatedNotification();

        return redirect()->back();
    }
}

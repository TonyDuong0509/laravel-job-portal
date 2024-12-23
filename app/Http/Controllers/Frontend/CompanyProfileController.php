<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateCompanyInfoRequest;
use App\Models\Company;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        $companyInfo = Company::where('user_id', Auth::id())->firstOrFail();
        return view('frontend.company-dashboard.profile.index', compact('companyInfo'));
    }

    public function updateCompanyInfo(UpdateCompanyInfoRequest $request)
    {
        $logoPath = $this->uploadFile($request, 'logo');
        $bannerPath = $this->uploadFile($request, 'banner');

        $data = [];
        if (!empty($logoPath)) $data['logo'] = $logoPath;
        if (!empty($bannerPath)) $data['banner'] = $bannerPath;
        $data['name'] = $request->name;
        $data['slug'] = $request->name;
        $data['bio'] = $request->bio;
        $data['vision'] = $request->vision;

        Company::updateOrCreate(
            [
                'user_id' => Auth::user()->id
            ], $data
        );

        notify()->success('️Updated successfully', '👍 Success !');

        return redirect()->back();
    }
}

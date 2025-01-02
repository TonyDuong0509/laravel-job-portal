<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateAccountInfoUpdateRequest;
use App\Http\Requests\Frontend\CandidateBasicProfileUpdateRequest;
use App\Http\Requests\Frontend\CandidateProfileInfoUpdateRequest;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateLanguage;
use App\Models\CandidateSkill;
use App\Models\City;
use App\Models\Country;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Profession;
use App\Models\Skill;
use App\Models\State;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

use function App\Helpers\isCandidateProfileComplete;

class CandidateProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        $candidate = Candidate::with(['skills', 'languages'])->where('user_id', Auth::user()->id)->first();
        $candidateExperiences = CandidateExperience::where('candidate_id', $candidate?->id)->orderBy('id', 'DESC')->get();
        $candidateEducation = CandidateEducation::where('candidate_id', $candidate?->id)->orderBy('id', 'DESC')->get();
        $experiences = Experience::all();
        $professions = Profession::all();
        $skills = Skill::all();
        $languages = Language::all();
        $countries = Country::all();
        $states = State::where('country_id', $candidate?->country)->get();
        $cities = City::where('state_id', $candidate?->state)->get();

        return view('frontend.candidate-dashboard.profile.index', compact(
            'candidate',
            'experiences',
            'professions',
            'skills',
            'languages',
            'candidateExperiences',
            'candidateEducation',
            'countries',
            'states',
            'cities'
        ));
    }

    public function basicInfoUpdate(CandidateBasicProfileUpdateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request, 'profile_picture');
        $cvPath = $this->uploadFile($request, 'cv');

        $data = [];
        if (!empty($imagePath)) $data['image'] = $imagePath;
        if (!empty($cvPath)) $data['cv'] = $imagePath;

        $data['full_name'] = $request->full_name;
        $data['title'] = $request->title;
        $data['experience_id'] = $request->experience_level;
        $data['website'] = $request->website;
        $data['birth_date'] = $request->date_of_birth;

        Candidate::updateOrCreate(
            [
                'user_id' => Auth::user()->id
            ],
            $data
        );

        $this->updateProfileStatus();

        Notify::updatedNotification();

        return redirect()->back();
    }

    public function profileInfoUpdate(CandidateProfileInfoUpdateRequest $request): RedirectResponse
    {
        $data = [];
        $data['gender'] = $request->gender;
        $data['marital_status'] = $request->marital_status;
        $data['profession_id'] = $request->profession;
        $data['status'] = $request->availability;
        $data['bio'] = $request->biography;

        Candidate::updateOrCreate(
            [
                'user_id' => Auth::user()->id
            ],
            $data
        );

        $candidate = Candidate::where('user_id', auth()->user()->id)->first();

        if (!$candidate) {
            throw new Exception("Candidate not found for user ID: " . auth()->user()->id);
        }

        CandidateLanguage::where('candidate_id', Auth::user()->id)?->delete();
        foreach ($request->language_you_know as $language) {
            $candidateLang = new CandidateLanguage();
            $candidateLang->candidate_id = $candidate->id;
            $candidateLang->language_id = $language;
            $candidateLang->save();
        }

        CandidateSkill::where('candidate_id', Auth::user()->id)?->delete();
        foreach ($request->skill_you_have as $skill) {
            $candidateSkill = new CandidateSkill();
            $candidateSkill->candidate_id = $candidate->id;
            $candidateSkill->skill_id = $skill;
            $candidateSkill->save();
        }

        $this->updateProfileStatus();

        Notify::updatedNotification();

        return redirect()->back();
    }

    public function accountInfoUpdate(CandidateAccountInfoUpdateRequest $request): RedirectResponse
    {
        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
            ]
        );

        $this->updateProfileStatus();
        Notify::updatedNotification();
        return redirect()->back();
    }

    public function accountEmailUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'account_email' => ['required', 'email']
        ]);

        Auth::use()->update(['email' => $request->account_email]);
        Notify::updatedNotification();
        return redirect()->back();
    }

    public function accountPasswordUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        Auth::use()->update(['password' => bcrypt($request->password)]);
        Notify::updatedNotification();

        return redirect()->back();
    }

    public function updateProfileStatus(): void
    {
        if (isCandidateProfileComplete()) {
            $candidate = Candidate::where('user_id', Auth::user()->id)->first();
            $candidate->profile_complete = 1;
            $candidate->visibility = 1;
            $candidate->save();
        }
    }
}

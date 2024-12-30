<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateBasicProfileUpdateRequest;
use App\Http\Requests\Frontend\CandidateProfileInfoUpdateRequest;
use App\Models\Candidate;
use App\Models\CandidateExperience;
use App\Models\CandidateLanguage;
use App\Models\CandidateSkill;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Profession;
use App\Models\Skill;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CandidateProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        $candidate = Candidate::with(['skills', 'languages'])->where('user_id', Auth::user()->id)->first();
        $candidateExperiences = CandidateExperience::where('candidate_id', $candidate->id)->orderBy('id', 'DESC')->get();
        $experiences = Experience::all();
        $professions = Profession::all();
        $skills = Skill::all();
        $languages = Language::all();
        return view('frontend.candidate-dashboard.profile.index', compact('candidate', 'experiences', 'professions', 'skills', 'languages', 'candidateExperiences'));
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

        Notify::updatedNotification();

        return redirect()->back();
    }
}

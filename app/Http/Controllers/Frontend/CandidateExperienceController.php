<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateExperienceStoreRequest;
use App\Models\CandidateExperience;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CandidateExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidateExperience = CandidateExperience::where('candidate_id', auth()->user()->candidateProfile->id)->orderBy('id', 'DESC')->get();
        return view('frontend.candidate-dashboard.profile.ajax-experience-table', compact('candidateExperience'))->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidateExperienceStoreRequest $request): Response
    {
        $experience = new CandidateExperience();
        $experience->candidate_id = auth()->user()->candidateProfile->id;
        $experience->company = $request->company;
        $experience->department = $request->department;
        $experience->designation = $request->designation;
        $experience->start = $request->start;
        $experience->end = $request->end;
        $experience->currently_working = $request->filled('currently_working') ? 1 : 0;
        $experience->responsibility = $request->responsibility;
        $experience->save();

        return response(['message' => 'Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $candidateExperience = CandidateExperience::findOrFail($id);
        return response($candidateExperience);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidateExperienceStoreRequest $request, string $id)
    {
        $experience = CandidateExperience::findOrFail($id);

        if ($experience->candidate_id !== auth()->user()->candidateProfile->id) {
            abort(404);
        }

        $experience->company = $request->company;
        $experience->department = $request->department;
        $experience->designation = $request->designation;
        $experience->start = $request->start;
        $experience->end = $request->end;
        $experience->currently_working = $request->filled('currently_working') ? 1 : 0;
        $experience->responsibility = $request->responsibility;
        $experience->save();

        return response(['message' => 'Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            CandidateExperience::findOrFail($id)->delete();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCandidatePageController extends Controller
{
    public function index(Request $request): View
    {
        $skills = Skill::all();
        $experiences = Experience::all();

        $query = Candidate::query();
        $query->where(['profile_complete' => 1, 'visibility' => 1]);

        if ($request->has('skills') && $request->filled('skills')) {
            $ids = Skill::whereIn('slug', $request->skills)->pluck('id')->toArray();
            $query->whereHas('skills', function ($subQuery) use ($ids) {
                $subQuery->whereIn('skill_id', $ids);
            });
        }

        if ($request->has('experience') && $request->filled('experience')) {
            $query->where('experience_id', $request->experience);
        }

        $candidates = $query->paginate(20);

        return view('frontend.pages.candidate-index', compact(
            'candidates',
            'skills',
            'experiences',
        ));
    }

    public function show(string $slug): View
    {
        $candidate = Candidate::where(['profile_complete' => 1, 'visibility' => 1, 'slug' => $slug])->firstOrFail();
        return view('frontend.pages.candidate-details', compact('candidate'));
    }
}

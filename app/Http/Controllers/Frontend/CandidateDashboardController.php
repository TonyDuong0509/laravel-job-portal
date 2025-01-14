<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateDashboardController extends Controller
{
    public function index(): View
    {
        $jobAppliedCount = AppliedJob::where('candidate_id', auth()->user()->id)->count();
        $userBookmarksCount = JobBookmark::where('candidate_id', auth()->user()->candidateProfile->id)->count();
        return view('frontend.candidate-dashboard.dashboard', compact(
            'jobAppliedCount',
            'userBookmarksCount'
        ));
    }
}

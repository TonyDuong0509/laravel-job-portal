<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CandidateMyJobController extends Controller
{
    public function index(): View
    {
        $appliedJobs = AppliedJob::with('job')->where('candidate_id', Auth::user()->id)->paginate(10);
        return view('frontend.candidate-dashboard.my-job.index', compact('appliedJobs'));
    }
}

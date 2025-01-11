<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CandidateJobBookmarkController extends Controller
{
    public function index(): View
    {
        $bookmarks = JobBookmark::where('candidate_id', Auth::user()->candidateProfile->id)->paginate(10);
        return view('frontend.candidate-dashboard.bookmarks.index', compact('bookmarks'));
    }

    public function save(string $id): Response
    {
        if (!Auth::check()) {
            throw ValidationException::withMessages(['Please login first to book mark this job! 🥺']);
        }
        if (Auth::check() && Auth::user()->role !== 'candidate') {
            throw ValidationException::withMessages(['Only Candidate will be able to book mark job! 🥺']);
        }

        $alreadyMarked = JobBookmark::where(['job_id' => $id, 'candidate_id' => Auth::user()->candidateProfile->id])->exists();
        if ($alreadyMarked) {
            throw ValidationException::withMessages(['You already marked this job! 🥺']);
        }

        $bookmark = new JobBookmark();
        $bookmark->job_id = $id;
        $bookmark->candidate_id = Auth::user()->candidateProfile->id;
        $bookmark->save();

        return response(['message' => 'Bookmark this job successullfy! 🎉', 'id' => $id], 200);
    }
}

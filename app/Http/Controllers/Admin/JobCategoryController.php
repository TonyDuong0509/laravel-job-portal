<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Services\Notify;
use App\Traits\Searchable;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JobCategoryController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:job category create|job category update|job category delete'])->only(['index']);
        $this->middleware(['permission:job category create'])->only(['create', 'store']);
        $this->middleware(['permission:job category update'])->only(['edit', 'update']);
        $this->middleware(['permission:job category delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = JobCategory::query();
        $this->search($query, ['name', 'slug']);
        $jobCategories = $query->orderBy('id', 'DESC')->paginate(20);
        return view('admin.job.job-category.index', compact('jobCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'icon' => ['required', 'max:255'],
                'name' => ['required', 'max:255']
            ]
        );

        $category = new JobCategory();
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->show_at_popular = $request->show_at_popular;
        $category->save();

        Notify::createdNotification();
        return redirect()->route('admin.job-categories.index');
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
    public function edit(string $id): View
    {
        $jobCategory = JobCategory::findOrFail($id);
        return View('admin.job.job-category.edit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate(
            [
                'icon' => ['required', 'max:255'],
                'name' => ['required', 'max:255']
            ]
        );

        $category = JobCategory::findOrFail($id);
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->show_at_popular = $request->show_at_popular;
        $category->save();

        Notify::updatedNotification();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $jobExist = Job::where('job_category_id', $id)->exists();
        if ($jobExist) {
            return response(['message' => 'This item is already been used can\'t delete! 🚫'], 500);
        }

        try {
            JobCategory::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }
}

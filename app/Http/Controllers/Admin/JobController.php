<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobCreateRequest;
use App\Models\Benefits;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobBenefits;
use App\Models\JobCategory;
use App\Models\JobRole;
use App\Models\JobSkills;
use App\Models\JobTag;
use App\Models\JobType;
use App\Models\SalaryType;
use App\Models\Skill;
use App\Models\State;
use App\Models\Tag;
use App\Services\Notify;
use App\Traits\Searchable;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JobController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:job create|job update|job delete'])->only(['index']);
        $this->middleware(['permission:job create'])->only(['create', 'store']);
        $this->middleware(['permission:job update'])->only(['edit', 'update', 'changeStatus']);
        $this->middleware(['permission:job delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Job::query();
        $this->search($query, ['title', 'slug']);
        $jobs = $query->orderBy('id', 'DESC')->paginate(20);
        $trashJobs = $query->onlyTrashed()->orderBy('id', 'DESC')->paginate(20);
        return view('admin.job.index', compact('jobs', 'trashJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $companies = Company::where(['profile_completion' => 1, 'visibility' => 1])->get();
        $categories = JobCategory::all();
        $countries = Country::all();
        $salaryTypes = SalaryType::all();
        $experiences = Experience::all();
        $educations = Education::all();
        $jobRoles = JobRole::all();
        $jobTypes = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('admin.job.create', compact(
            'companies',
            'categories',
            'countries',
            'salaryTypes',
            'experiences',
            'educations',
            'jobRoles',
            'jobTypes',
            'tags',
            'skills'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCreateRequest $request): RedirectResponse
    {
        $job = new Job();
        $job->title = $request->title;
        $job->company_id = $request->company;
        $job->job_category_id = $request->category;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;
        $job->country_id = $request->country;
        $job->state_id = $request->state;
        $job->city_id = $request->city;
        $job->address = $request->address;
        $job->salary_mode = $request->salary_mode;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->custom_salary = $request->custom_salary;
        $job->salary_type_id = $request->salary_type;
        $job->job_experience_id = $request->experience;
        $job->job_role_id = $request->job_role;
        $job->education_id = $request->education;
        $job->job_type_id = $request->job_type;
        $job->featured = $request->has('featured') ? 1 : 0;
        $job->highlight = $request->has('highlight') ? 1 : 0;
        $job->description = $request->description;
        $job->save();

        foreach ($request->tags as $tag) {
            $createItem = new JobTag();
            $createItem->job_id = $job->id;
            $createItem->tag_id = $tag;
            $createItem->save();
        }

        $benefits = explode(',', $request->benefits);
        foreach ($benefits as $benefit) {
            $createItem = new Benefits();
            $createItem->company_id = $job->company_id;
            $createItem->name = $benefit;
            $createItem->save();

            // Store job benefit
            $jobBenefit = new JobBenefits();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $createItem->id;
            $jobBenefit->save();
        }

        foreach ($request->skills as $skill) {
            $createItem = new JobSkills();
            $createItem->job_id = $job->id;
            $createItem->skill_id = $skill;
            $createItem->save();
        }

        Notify::createdNotification();
        return redirect()->route('admin.jobs.index');
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
        $job = Job::findOrFail($id);
        $companies = Company::where(['profile_completion' => 1, 'visibility' => 1])->get();
        $categories = JobCategory::all();
        $countries = Country::all();
        $states = State::where('country_id', $job->country_id)->get();
        $cities = City::where('state_id', $job->state_id)->get();
        $salaryTypes = SalaryType::all();
        $experiences = Experience::all();
        $educations = Education::all();
        $jobRoles = JobRole::all();
        $jobTypes = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('admin.job.edit', compact(
            'companies',
            'categories',
            'countries',
            'states',
            'cities',
            'salaryTypes',
            'experiences',
            'educations',
            'jobRoles',
            'jobTypes',
            'tags',
            'skills',
            'job'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $job = Job::findOrFail($id);
        $job->title = $request->title;
        $job->company_id = $request->company;
        $job->job_category_id = $request->category;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;
        $job->country_id = $request->country;
        $job->state_id = $request->state;
        $job->city_id = $request->city;
        $job->address = $request->address;
        $job->salary_mode = $request->salary_mode;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->custom_salary = $request->custom_salary;
        $job->salary_type_id = $request->salary_type;
        $job->job_experience_id = $request->experience;
        $job->job_role_id = $request->job_role;
        $job->education_id = $request->education;
        $job->job_type_id = $request->job_type;
        $job->featured = $request->has('featured') ? 1 : 0;
        $job->highlight = $request->has('highlight') ? 1 : 0;
        $job->description = $request->description;
        $job->save();

        JobTag::where('job_id', $id)->delete();
        foreach ($request->tags as $tag) {
            $createItem = new JobTag();
            $createItem->job_id = $job->id;
            $createItem->tag_id = $tag;
            $createItem->save();
        }

        $selectedBenefits = JobBenefits::where('job_id', $id);
        foreach ($selectedBenefits->get() as $selectedBenefit) {
            Benefits::find($selectedBenefit->benefit_id)->delete();
        }
        $selectedBenefits->delete();

        $benefits = explode(',', $request->benefits);
        foreach ($benefits as $benefit) {
            $createItem = new Benefits();
            $createItem->company_id = $job->company_id;
            $createItem->name = $benefit;
            $createItem->save();

            // Store job benefit
            $jobBenefit = new JobBenefits();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $createItem->id;
            $jobBenefit->save();
        }

        JobSkills::where('job_id', $id)->delete();
        foreach ($request->skills as $skill) {
            $createItem = new JobSkills();
            $createItem->job_id = $job->id;
            $createItem->skill_id = $skill;
            $createItem->save();
        }

        Notify::updatedNotification();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Job::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again !']);
        }
    }

    public function forceDelete(string $id): Response
    {
        try {
            Job::onlyTrashed()->findOrFail($id)->forceDelete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again !']);
        }
    }

    public function restoreDelete(string $id)
    {
        $job = Job::onlyTrashed()->findOrFail($id); // Lấy bản ghi đã bị soft delete
        $job->restore(); // Khôi phục bản ghi
        Notify::successNotifycation('Restore job successfully');
        return redirect()->back();
    }

    public function changeStatus(string $id): Response
    {
        $job = Job::findOrFail($id);
        $job->status = $job->status == 'active' ? 'pending' : 'active';
        $job->save();
        Notify::updatedNotification();
        return response(['message' => 'success'], 200);
    }
}

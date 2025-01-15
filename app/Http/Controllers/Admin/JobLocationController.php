<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobLocationCreateRequest;
use App\Http\Requests\Admin\JobLocationUpdateRequest;
use App\Models\Country;
use App\Models\JobLocation;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JobLocationController extends Controller
{
    use FileUploadTrait;
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:sections']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = JobLocation::query();
        $this->search($query, ['country', 'status']);
        $jobLocations = $query->paginate(10);
        return view('admin.job-location.index', compact('jobLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();
        return view('admin.job-location.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobLocationCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request, 'image');
        $location = new JobLocation();
        $location->image = $imagePath;
        $location->country_id = $request->country;
        $location->status = $request->status;
        $location->save();
        Notify::createdNotification();

        return to_route('admin.job-location.index');
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
        $jobLocation = JobLocation::findOrFail($id);
        $countries = Country::all();
        return view('admin.job-location.edit', compact(
            'jobLocation',
            'countries'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobLocationUpdateRequest $request, string $id): RedirectResponse
    {
        $location = JobLocation::findOrFail($id);
        $imagePath = $this->uploadFile($request, 'image');
        if (!empty($imagePath)) $location->image = $imagePath;
        $location->country_id = $request->country;
        $location->status = $request->status;
        $location->save();
        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            JobLocation::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }
}

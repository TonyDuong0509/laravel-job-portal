<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationType;
use App\Services\Notify;
use Illuminate\Http\Request;
use App\Traits\Searchable;

class OrganizationTypeController extends Controller
{
    use Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OrganizationType::query();
        $this->search($query, ['name']);
        $organizationTypes = $query->paginate(10);
        return view('admin.organization-type.index', compact('organizationTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organization-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:organization_types,name'],
        ]);

        $type = new OrganizationType();
        $type->name = $request->name;
        $type->save();

        Notify::createdNotification();

        return redirect()->route('admin.organization-types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $organizationType = OrganizationType::findOrFail($id);

        return view('admin.organization-type.edit', compact('organizationType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organizationType = OrganizationType::findOrFail($id);

        return view('admin.organization-type.edit', compact('organizationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:industry_types,name'],
        ]);

        $organizationType = OrganizationType::findOrFail($id);
        $organizationType->name = $request->name;
        $organizationType->slug = str_replace(' ', '-', $request->name);
        $organizationType->save();

        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            OrganizationType::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }
}

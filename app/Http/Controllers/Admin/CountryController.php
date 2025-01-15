<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:job locations']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Country::query();
        $this->search($query, ['name']);
        $countries = $query->paginate(50);

        if (request('page') && $countries->isEmpty()) {
            $previousPage = $countries->currentPage() - 1;
            if ($previousPage < 1) {
                $previousPage = 1;
            }
            return redirect()->route('admin.countries.index', ['page' => $previousPage]);
        }

        return view('admin.location.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name'],
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->save();

        Notify::createdNotification();

        return redirect()->route('admin.countries.index');
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
    public function edit(string $id)
    {
        $country = Country::findOrFail($id);
        return view('admin.location.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name,'],
        ]);
        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->save();

        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Country::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Some thing went wrong, please try again.'], 500);
        }
    }
}

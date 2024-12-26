<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    use Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        $query = City::query();
        $query->with(['country', 'state']);
        $this->search($query, ['name']);
        $cities = $query->orderBy('id', 'DESC')->paginate(100);

        if (request('page') && $cities->isEmpty()) {
            $previousPage = $cities->currentPage() - 1;
            if ($previousPage < 1) {
                $previousPage = 1;
            }
            return redirect()->route('admin.cities.index', ['page' => $previousPage]);
        }

        return view('admin.location.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();
        $states = State::all();

        return view('admin.location.city.create', compact('countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'city' => ['required', 'max:255'],
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
        ]);

        $city = new City();
        $city->name = $request->city;
        $city->state_id = $request->state;
        $city->country_id = $request->country;
        $city->save();

        Notify::createdNotification();

        return to_route('admin.cities.index');
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
        $city = City::findOrFail($id);
        $countries = Country::all();
        $states = State::where('country_id', $city->country_id)->get();
        return view('admin.location.city.edit', compact('states', 'countries', 'city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'city' => ['required', 'max:255'],
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
        ]);

        $city = City::findOrFail($id);
        $city->name = $request->city;
        $city->country_id = $request->country;
        $city->state_id = $request->state;

        $city->save();

        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            City::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Some thing went wrong, please try again.'], 500);
        }
    }
}

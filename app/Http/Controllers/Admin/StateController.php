<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StateController extends Controller
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
        $query = State::query();
        $query->with('country');
        $this->search($query, ['name']);
        $states = $query->orderBy('id', 'DESC')->paginate(100);

        if (request('page') && $states->isEmpty()) {
            $previousPage = $states->currentPage() - 1;
            if ($previousPage < 1) {
                $previousPage = 1;
            }
            return redirect()->route('admin.states.index', ['page' => $previousPage]);
        }

        return view('admin.location.state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();

        return view('admin.location.state.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'country' => ['required', 'integer'],
        ]);

        $state = new State();
        $state->name = $request->name;
        $state->country_id = $request->country;
        $state->save();

        Notify::createdNotification();

        return redirect()->route('admin.states.index');
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
        $state = State::findOrFail($id);
        $countries = Country::all();
        return view('admin.location.state.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'country' => ['required', 'integer'],
        ]);

        $state = State::findOrFail($id);
        $state->name = $request->name;
        $state->country_id = $request->country;

        $state->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            State::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Some thing went wrong, please try again.'], 500);
        }
    }
}

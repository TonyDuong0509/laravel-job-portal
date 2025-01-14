<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Profession;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProfessionController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Profession::query();
        $this->search($query, ['name']);
        $professions = $query->paginate(20);
        return view('admin.profession.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.profession.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:professions,name']
        ]);
        $profession = new Profession();
        $profession->name = $request->name;
        $profession->save();

        Notify::createdNotification();

        return redirect()->route('admin.professions.index');
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
        $profession = Profession::findOrFail($id);
        return view('admin.profession.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:professions,name']
        ]);
        $profession = Profession::findOrFail($id);
        $profession->name = $request->name;
        $profession->save();

        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $candidateExist = Candidate::where('profession_id', $id)->exists();
        if ($candidateExist) {
            return response(['message' => 'This item is already been used can\'t delete! 🚫'], 500);
        }

        try {
            Profession::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }
}

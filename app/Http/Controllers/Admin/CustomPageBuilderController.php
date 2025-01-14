<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPageBuilder;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomPageBuilderController extends Controller
{
    use Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $query = CustomPageBuilder::query();
        $this->search($query, ['page_name', 'slug']);
        $pages = $query->paginate(10);
        return view('admin.page-builder.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'page_name' => ['required', 'max:255'],
                'content' => ['required']
            ]
        );

        $page = new CustomPageBuilder();
        $page->page_name = $request->page_name;
        $page->content = $request->content;
        $page->save();

        Notify::createdNotification();
        return to_route('admin.page-builder.index');
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
        $page = CustomPageBuilder::findOrFail($id);
        return view('admin.page-builder.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate(
            [
                'page_name' => ['required', 'max:255'],
                'content' => ['required']
            ]
        );

        $page = CustomPageBuilder::findOrFail($id);
        $page->page_name = $request->page_name;
        $page->content = $request->content;
        $page->save();

        Notify::updatedNotification();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            CustomPageBuilder::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Some thing went wrong, please try again.'], 500);
        }
    }
}

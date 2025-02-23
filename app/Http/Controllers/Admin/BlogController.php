<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCreateRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Blog;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BlogController extends Controller
{
    use FileUploadTrait;
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:blogs']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Blog::query();
        $this->search($query, ['title', 'slug']);
        $blogs = $query->orderBy('id', 'DESC')->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request, 'image');
        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->author_id = Auth::user()->id;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->featured = $request->featured;
        $blog->save();

        Notify::createdNotification();

        return to_route('admin.blogs.index');
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
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, string $id): RedirectResponse
    {
        $imagePath = $this->uploadFile($request, 'image');
        $blog = Blog::findOrFail($id);
        if ($imagePath) $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->author_id = Auth::user()->id;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->featured = $request->featured;
        $blog->save();

        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Blog::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Some thing went wrong, please try again.'], 500);
        }
    }
}

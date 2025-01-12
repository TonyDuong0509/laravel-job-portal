<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendBlogPageController extends Controller
{
    use Searchable;

    public function index(): View
    {
        $query = Blog::query();
        $this->search($query, ['title', 'slug']);
        $blogs = $query->where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        $featured = Blog::where(['status' => 1, 'featured' => 1])->orderBy('id', 'DESC')->take(8)->get();
        return view('frontend.pages.blog-index', compact('blogs', 'featured'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.blog-details', compact('blog'));
    }
}

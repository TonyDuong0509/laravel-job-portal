<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearnMore;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearnMoreController extends Controller
{
    use FileUploadTrait;

    public function __construct()
    {
        $this->middleware(['permission:sections']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $learn = LearnMore::first();
        return view('admin.learn-more.index', compact('learn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate(
            [
                'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
                'title' => ['required', 'max:255'],
                'main_title' => ['required', 'max:255'],
                'sub_title' => ['required', 'max:255'],
                'url' => ['nullable']
            ]
        );

        $imagePath = $this->uploadFile($request, 'image');
        $data = [];
        if ($request->has('image')) $data['image'] = $imagePath;
        $data['title'] = $request->title;
        $data['main_title'] = $request->main_title;
        $data['sub_title'] = $request->sub_title;
        $data['url'] = $request->url;

        LearnMore::updateOrCreate(
            ['id' => 1],
            $data,
        );

        Notify::updatedNotification();

        return redirect()->back();
    }
}

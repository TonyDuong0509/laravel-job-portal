<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Country;
use App\Models\Hero;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\LearnMore;
use App\Models\Plan;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hero = Hero::first();
        $jobCategories = JobCategory::all();
        $countries = Country::all();
        $jobCount = Job::count();
        $popularJobCategories = JobCategory::withCount(['jobs' => function ($subQuery) {
            $subQuery->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->where('show_at_popular', 1)->get();
        $featuredJobCategories = JobCategory::where('show_at_featured', 1)->take(10)->get();
        $whyChooseUs = WhyChooseUs::first();
        $learn = LearnMore::first();
        $counter = Counter::first();
        $companies = Company::select('logo', 'name', 'slug', 'country')->withCount(['jobs' => function ($subQuery) {
            $subQuery->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->where(['profile_completion' => 1, 'visibility' => 1])->latest()->take(45)->get();
        $jobLocations = JobLocation::all();
        $plans = Plan::where(['frontend_show' => 1, 'show_at_home' => 1])->get();
        return view('frontend.home.index', compact(
            'plans',
            'hero',
            'jobCategories',
            'countries',
            'jobCount',
            'popularJobCategories',
            'featuredJobCategories',
            'whyChooseUs',
            'learn',
            'counter',
            'companies',
            'jobLocations',
        ));
    }
}

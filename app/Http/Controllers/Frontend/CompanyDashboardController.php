<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyDashboardController extends Controller
{
    public function index(): View
    {
        $jobPosts = Job::where('company_id', auth()->user()->company?->id)->where('status', 'pending')->count();
        $totalJobs = Job::where('company_id', auth()->user()->company?->id)->count();
        $totalOrders = Order::where('company_id', auth()->user()->company?->id)->count();
        return view('frontend.company-dashboard.dashboard', compact(
            'jobPosts',
            'totalJobs',
            'totalOrders'
        ));
    }
}

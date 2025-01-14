<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribers;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsletterController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate(
            [
                'email' => ['required', 'email', 'unique:subscribers,email']
            ]
        );

        $subscribe = new Subscribers();
        $subscribe->email = $request->email;
        $subscribe->save();

        Notify::createdNotification();

        return response(['message' => 'Subscribed successfully! 🎉'], 200);
    }
}

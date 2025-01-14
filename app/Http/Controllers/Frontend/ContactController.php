<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactMailRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('frontend.pages.contact');
    }

    public function sendMail(ContactMailRequest $request): Response
    {
        Mail::to(config('settings.site_email'))->send(new ContactMail($request->name, $request->email, $request->subject, $request->message));

        return response(['message' => 'Message sent successfully! 🎉'], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Subscribers;
use App\Services\Notify;
use App\Traits\Searchable;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    use Searchable;

    public function index(): View
    {
        $query = Subscribers::query();
        $this->search($query, ['email']);
        $subscribers = $query->orderBy('id', 'DESC')->paginate(10);
        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function destroy(string $id): Response
    {
        try {
            Subscribers::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }

    public function sendMail(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'subject' => ['required', 'max:255'],
                'message' => ['required']
            ]
        );

        $subscribers = Subscribers::all();
        foreach ($subscribers as $key => $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($request->subject, $request->message));
        }

        Notify::successNotifycation('Newsletter sent successfully! 🎉');

        return redirect()->back();
    }
}

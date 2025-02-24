<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request) {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallBack(Request $request) {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('google_id', $user->id)->first();

        if(!is_null($findUser)) {
            Auth::login($findUser);
        }
        else {
            $findUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => encrypt('123123123'),
                'role' => 'candidate'
            ]);
            Auth::login($findUser);
        }

        Notify::successNotifycation('Đăng nhập thành công với tài khoản Google');
        return redirect()->intended(RouteServiceProvider::CANDIDATE_DASHBOARD);
    }
}

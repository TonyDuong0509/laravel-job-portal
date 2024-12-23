@extends('frontend.layouts.master')

@section('contents')
    <section class="pt-120 login-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
                    <div class="login-register-cover">
                        <div class="text-center">
                            <h2 class="mt-10 mb-5 text-brand-1">Reset Password!</h2>
                        </div>
                        <form class="login-register text-start mt-20" action="{{ route('password.store') }}"
                              method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group">
                                <label for="input-1">Email *</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="input-1"
                                       type="email" required name="email"
                                       placeholder="example@gmail.com" value="{{ old('email', $request->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>

                            <div class="form-group">
                                <label for="input-1">Password *</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       id="input-1"
                                       type="password" required name="password"
                                       placeholder="new password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            </div>

                            <div class="form-group">
                                <label for="input-1">Password Confirmation *</label>
                                <input
                                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                    id="input-1"
                                    type="password" required autocomplete="new-password" name="password_confirmation"
                                    placeholder="password confirmation">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default hover-up w-100" type="submit" name="continue">Change
                                    Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-120"></div>
@endsection


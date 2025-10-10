@extends('layouts.auth')

@section('title')
    Login
@endsection
@section('content')
    <div class="fxt-content">
        <h2>Login into your account</h2>
        <div class="fxt-form">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" placeholder="Email" required="required" value="{{ $email ?? old('email') }}"
                            autocomplete="email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                        <label for="">New password</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="********"
                            required="required">
                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                        <label for="">Re-enter password</label>
                        <input id="password" type="password" class="form-control" name="password_confirmation" placeholder="********"
                            required="required">
                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                    </div>
                </div>
    
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                        <button type="submit" class="fxt-btn-fill">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="fxt-footer">
            <div class="fxt-transformY-50 fxt-transition-delay-9">
                <p>Back to login page<a href="{{ route('login') }}" class="switcher-text2 inline-text">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection

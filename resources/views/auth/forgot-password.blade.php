@extends('layouts.auth')

@section('title')
    Login
@endsection
@section('content')
<div class="fxt-content">
						<h2>Forgot password</h2>
						<div class="fxt-form">
							<form method="POST" action=""> 
                                @csrf
                                 
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required="required" value="{{ old('email')}}" autocomplete="email">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
									</div>
								</div>
								
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-3">
										<div class="fxt-checkbox-area">
											<div class="checkbox">
												<input id="checkbox1" type="checkbox">
												<label for="checkbox1">Keep me logged in</label>
											</div>
											<a href="{{ route('login') }}" class="switcher-text">Login</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" class="fxt-btn-fill">Send reset link</button>
									</div>
								</div>
							</form>
						</div>
						<div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-9">
								<p>Don't have an account?<a href="{{route ('register') }}" class="switcher-text2 inline-text">Register</a></p>
							</div>
						</div>
</div>
@endsection

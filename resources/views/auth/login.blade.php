@extends('layout.auth-app')
@section('titlepage','Login')

@section('content')
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form" method="POST" action="{{ route('login') }}">
				@csrf
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<!-- <img src="{{asset('file/logo-2.png')}}" alt="logo" style="width:65%"> -->
								<h5 class="font-weight-bold mb-0">{{env("APP_NAME")}}</h5>
								<h5 class="font-weight-light mb-0">{{env("APP_NAME_FULL")}}</h5>
								<hr>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="username" required autocomplete="username" autofocus>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								@error('username')
									<span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i> {{ $message }}</span>
                                    {{-- <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> --}}
                                @enderror
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								@error('password')
									<span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i> {{ $message }}</span>
                                @enderror
							</div>

							<!-- <div class="form-group d-flex align-items-center">

								<a href="{{ route('password.request') }}" class="ml-auto">Forgot password?</a>
							</div> -->

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<!-- <span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span> -->
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
            @include('layout.auth-footer')
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

@endsection

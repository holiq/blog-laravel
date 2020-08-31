@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="row justify-content-center">
		<div class="col-lg-4 col-md-6 col-12 bg-white">
			<div class="p-3 m-2">
				<h4 class="text-dark font-weight-normal">Welcome Admin</h4>
			<p class="text-muted">Please login to enter the dashboard.</p>
				<form method="POST" action="{{ route('admin.login') }}" class="needs-validation" novalidate="">
					@csrf
					@method('post')
					<div class="form-group">
						<label for="email">Email</label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
						
					<div class="form-group">
						<div class="d-block">
							<label for="password" class="control-label">{{ __('Password') }}</label>
						</div>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
						
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

							<label class="custom-control-label" for="remember">
								{{ __('Remember Me') }}
							</label>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">
							{{ __('Login') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection

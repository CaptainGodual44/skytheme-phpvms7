@extends('auth.login_layout')
@section('title', __('common.login'))

@section('content')
  <div class="d-flex justify-content-center flex-column min-vh-100">
    <div class="col-md-8 mx-auto content-center">
      <div class="card-group d-block d-md-flex row">
        <div class="card col-md-7 p-4 mb-0">
          <form method="post" action="{{ url('/login') }}" class="form">
            @csrf
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-body-secondary">Sign In to your account</p>
              <div class="input-group mb-3">
                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required type="text" name="email" value="{{ old('email') }}" placeholder="@lang('common.email') @lang('common.or') @lang('common.pilot_id')">
                @if ($errors->has('email'))
                  <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <div class="input-group mb-4">
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                  placeholder="@lang('auth.password')"
                  required
                />
                @if ($errors->has('password'))
                  <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
              </div>
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-primary px-4">@lang('common.login')</button>
                </div>
                <div class="col-6 text-end">
                  <a href="{{route('password.request')}}" class="btn btn-link px-0">Forgot password?</a>
                </div>
              </div>
              @if(config('services.discord.enabled'))
              <div class="mt-2 d-grid">
                 <a href="{{ route('oauth.redirect', ['provider' => 'discord']) }}" class="btn btn-round" style="background-color:#738ADB;"> @lang('auth.loginwith', ['provider' => 'Discord']) </a>
              </div>
              @endif
            </div>
          </form>
        </div>
        <div class="card col-md-5 text-white bg-primary py-5">
          <div class="card-body text-center">
            <div>
              <h2>Sign up</h2>
              <p>Don't have a account? Join Us in our Virtual Skies!</p>
              <a href="{{route('register')}}" class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright text-center">
      &copy;
      <script>
        document.write(new Date().getFullYear())
      </script>
      {{config('app.name')}}, powered by <a href="http://www.phpvms.net" target="_blank">phpvms</a>.
    </div>
  </div>

@endsection

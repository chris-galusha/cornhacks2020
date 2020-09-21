@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')

  @include('snippets/banner')
  <div class="content">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="field">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="control">
          <input id="email" type="email" class="input @error('email') is-warning @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
              <span class="is-notification is-warning" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="field">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

          <div class="control">
            <input id="password" type="password" class="input @error('password') is-warning @enderror" name="password" required autocomplete="current-password">

              @error('password')
                <span class="is-notification is-warning" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="field">
            <div class="control offset-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
                </label>
              </div>
            </div>
          </div>

          <div class="buttons">
            <a href="/home" class='button is-link'>Back</a>
            <button type="submit" class="button is-success">Login</button>
            @if (Route::has('password.request'))
              <a class="button is-info" href="{{ route('password.request') }}">'Forgot Your Password?</a>
            @endif
          </div>
        </form>
  </div>
@endsection('content')

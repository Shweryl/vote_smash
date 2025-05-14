@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-8">
            <div class="card p-5 shadow">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <img src="{{asset('images/logo.png')}}" width="150" alt="">
                            <h3 class="fw-bold">Welcome to Vote Smash</h3>
                            <p>Already have an account?</p>
                            <a href="{{route('login')}}" class="btn btn-secondary" class="btn btn-secondary">Sign in</a>
                        </div>
                    </div>
                    <div class="col-md-6 bg-light">
                        <h3 class="mb-4 fw-bold text-primary">Sign up</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="mb-3">{{ __('Email Address') }}</label>

                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-3">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-3">Confirm Password</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="">
                                <button type="submit" class="btn btn-secondary px-5 w-100">
                                    {{ __('Register') }}
                                </button>



                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.withNav')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="d-flex align-items-center w-100">
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <img src="{{asset('images/profile_vector.png')}}" width="550" alt="">

                            </div>
                        </div>
                        <div class="col-md-6 bg-info-opacity p-5">
                            <h3 class="mb-4 fw-bold text-primary">Update Profile</h3>
                            <form method="POST" action="{{ route('update.profile', ['id' => $user->id]) }}" class="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="email" class="mb-3">{{ __('Email Address') }}</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="Enter Email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="first_name" class="mb-3">First Name</label>

                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}" required placeholder="Enter First Name" autocomplete="FirstName" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="last_name" class="mb-3">Last Name</label>

                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name', $user->last_name) }}" placeholder="Enter Last Name" required autocomplete="LastName" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="telephone" class="mb-3">Telephone</label>

                                    <input id="telephone" type="text"
                                        class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                        value="{{ old('telephone', $user->telephone) }}" placeholder="Enter Phone Number" required autocomplete="telephone" autofocus>

                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="profile_image" class="mb-3">Upload Profile</label>

                                    <input id="profile" type="file"
                                        class="form-control @error('profile_image') is-invalid @enderror" name="profile_image"
                                        value="{{ old('profile_image', $user->profile_image) }}" required autocomplete="profile_image" autofocus>

                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button class="btn btn-secondary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.withNav')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-4">
                <div class="card p-5 shadow border border-1 border-secondary">
                    <h3 class="mb-2 fw-bold text-primary text-center">User Profile</h3>
                    <div class="text-center mb-3">
                        <img src="{{$user->profile_image ? asset('storage/'.$user->profile_image) : asset('images/default.jpg')}}" class="rounded-pill border border-3 border-secondary" width="120" height="120" alt="">
                    </div>
                    <div class="d-flex g-4">
                        <div class="">
                            <p>Email :</p>
                            <p>First Name :</p>
                            <p>Last Name :</p>
                            <p>Telephone :</p>
                            <p>Wallet Status :</p>
                            <p>Tickets Purchased :</p>
                        </div>
                        <div class="">
                            <p>{{$user->email}}</p>
                            <p>{{$user->first_name ?? '-' }}</p>
                            <p>{{$user->last_name ?? '-' }}</p>
                            <p>{{$user->telephone ?? '-' }}</p>
                            <p class="fw-bold text-secondary">$ {{$user->wallet ?? '-' }} </p>
                            <p>You have no tickets purchased yet.</p>
                        </div>
                    </div>

                    <a href="{{route('profile.form')}}" class="btn btn-secondary">Update</a>
                </div>
            </div>
        </div>
    </div>
@endsection

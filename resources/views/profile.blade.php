@extends('layouts.withNav')

@section('content')
    <div class="container h-100" x-data="profileData">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-7">

                <div class="card p-5 shadow border border-1 border-secondary">
                    <h3 class="mb-2 fw-bold text-primary text-center">User Profile</h3>
                    <div class="text-center mb-3">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default.jpg') }}"
                            class="rounded-pill border border-3 border-secondary" width="120" height="120" alt="">
                    </div>
                    <div class="d-flex g-4 justify-content-center">
                        <div class="">
                            <p>Email :</p>
                            <p>First Name :</p>
                            <p>Last Name :</p>
                            <p>Telephone :</p>
                        </div>
                        <div class="ms-3">
                            <p>{{ $user->email }}</p>
                            <p>{{ $user->first_name ?? '-' }}</p>
                            <p>{{ $user->last_name ?? '-' }}</p>
                            <p>{{ $user->telephone ?? '-' }}</p>
                        </div>

                    </div>
                    <div class="text-center">
                        <a href="{{ route('profile.form') }}" class="btn btn-secondary px-4">Update</a>
                    </div>
                    <div class="d-flex g-4 justify-content-center mt-4">
                        <div class="">
                            <p>Wallet Status :</p>
                            <p>Tickets Purchased :</p>
                        </div>
                        <div class="ms-3">
                            <p class="fw-bold text-secondary">$ {{ $user->wallet ?? '-' }} </p>
                            <p>{{ $user->tours()->count() > 0 ? 'Your tickets' : 'You have no tickets purchased yet.' }}</p>
                        </div>

                    </div>
                    @if ($user->tours()->count() > 0)
                        <div class="row">
                            @foreach ($tours as $tour)
                                <div class="col-12 mb-4">
                                    <div class="card p-4 border border-1 border-secondary">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4 class="fw-bold text-secondary">{{ $tour->title }}</h4>
                                                <span class="fw-bold text-primary "> Contributed by
                                                    {{ $tour->user->full_name }}</span>
                                                <p class="mt-3">{{ $tour->question }}</p>
                                                <a href=""
                                                    class="btn btn-outline-secondary">{{ $tour->category->name }}</a>
                                            </div>
                                            <div class="col-6">
                                                <img src="{{ asset('storage/' . $tour->cover_image) }}"
                                                    class="w-100 h-100 object-fit-cover" alt="">
                                            </div>
                                        </div>
                                        <p class="mb-2 mt-4"><strong>Video</strong> : {{ $tour->video_link }}</p>
                                        <p><strong>Live Event</strong> : {{ $tour->live_event_link }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p>
                                                <span x-text="formattedDate('{{$tour->tour_date}}')"></span>
                                                <span x-text="formattedTime('{{$tour->tour_time}}')"></span>
                                            </p>
                                            <p class="fw-bold text-secondary">$ 1.00 CAD</p>
                                        </div>

                                        <div class="">
                                            <button type="button" class="btn btn-outline-secondary me-2">
                                                Entry ticket for tour
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if (!request()->has('show_more'))
                            <div class="">
                                <a href="{{ route('user.profile', ['show_more' => 1]) }}" class="btn btn-secondary">
                                    Show More
                                </a>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('profileData', () => ({
                formattedDate(tourdate) {
                    const date = new Date(tourdate);
                    return date.toLocaleDateString('en-US', {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric'
                    });

                },

                formattedTime(tourTime) {
                    const [hour, minute] = tourTime.split(':');
                    const date = new Date();
                    date.setHours(hour, minute);

                    return date.toLocaleTimeString([], {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                },
            }))

        })
    </script>
@endpush

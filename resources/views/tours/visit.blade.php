@extends('layouts.withNav')

@section('content')
    <div class="container-fluid h-100 px-0" x-data="visitData">
        <div class="banner bg-secondary py-4 d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h2 class="fw-bold mb-3">Garner votes for your MVC in this tour!​</h2>
                <p>Equip your organization with the tools to create the environment to improve the strength your message to
                    garner votes for your MVC (minimal viable consensus).</p>
            </div>
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-4 border border-1 border-secondary position-relative">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="fw-bold text-secondary">{{ $tour->title }}</h4>
                            <span class="fw-bold text-primary "> Contributed by {{ $tour->user->full_name }}</span>
                            <p class="mt-3">{{ $tour->question }}</p>
                            <a href="" class="btn btn-outline-secondary">{{ $tour->category->name }}</a>
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('storage/' . $tour->cover_image) }}" class="w-100 h-100 object-fit-cover"
                                alt="">
                        </div>
                    </div>
                    <p class="mb-2 mt-4"><strong>Video</strong> : {{ $tour->video_link }}</p>
                    <p><strong>Live Event</strong> : {{ $tour->live_event_link }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <p><span x-text="formattedTime(tour.tour_time)"></span>
                            <span x-text="formattedDate(tour.tour_date)"></span>
                        </p>
                        <p class="fw-bold text-secondary">$ 1.00 CAD</p>
                    </div>
                    @if (Auth::user()->tours->contains($tour->id))
                        <div class="">
                            <button type="button" class="btn btn-outline-secondary me-2">
                                Purchased Tour
                            </button>
                            <a href="{{ route('tour.show', $tour->id) }}" class="btn btn-outline-secondary">Join Tour</a>
                        </div>
                    @else
                        <div class="position-absolute top-0 start-100 translate-middle">
                            <button type="button" class="btn btn-secondary rounded-pill p-3 fw-bold wavy-btn"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Purchase Tour
                            </button>
                        </div>
                    @endif
                </div>


            </div>
        </div>

        {{-- Modal Box --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold text-secondary" id="exampleModalLabel">Billing Info</h1>
                        <button type="button" class="btn-close bg-secondary" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tour.purchase') }}" method="POST" id="purchase-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $tour->id }}">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Are you sure to buy this tour?</label>
                                <input type="text" class="form-control" id="userConfirm">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Type Your Account Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label d-block">After you retrieved, Your account
                                    balace will be {{ Auth::user()->wallet - 1 }} CAD</label>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="me-2" id="password">
                                    <span>Okie</span>
                                </div>
                            </div>
                            @if (Auth::user()->wallet < 2)
                                <small class="text-danger fw-bold"> To retreive tour, your wallet must have at least 2
                                    CAD.</small>
                            @endif
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        @if (Auth::user()->wallet > 2)
                            <button form="purchase-form" type="submit" class="btn btn-secondary px-2">Buy</button>
                        @else
                            <button type="button" class="btn btn-secondary px-2" disabled>Buy</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('visitData', () => ({
                tour : @json($tour),
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

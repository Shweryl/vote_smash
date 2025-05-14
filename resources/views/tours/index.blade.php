@extends('layouts.withNav')

@section('content')
    <div class="container-fluid h-100 px-0">
        <div class="banner bg-secondary py-4 d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h2 class="fw-bold mb-3">Ready to reimage your diversity & equality platform?</h2>
                <p>Equip your organization with the tools to create the environment to improve the strength your message
                    to garner votes for your MVC (minimal viable consensus)</p>
            </div>
        </div>

        <div class="tour-list mt-4 d-flex justify-content-center">
            <div class="col-md-11">
                <div class="row d-flex align-items-stretch">
                    @foreach ($tours as $tour)
                        <div class="col-md-4 col-6 mb-4">
                            <div class="card p-4 border border-1 border-secondary shadow h-100 d-flex flex-column">
                                <div class="position-relative">
                                    <a href="{{route('tour.visit',$tour->id)}}">
                                        <img src="{{ asset('storage/' . $tour->cover_image) }}" class="w-100 object-fit-cover"
                                        height="200" alt="">
                                    </a>
                                    <p
                                        class="bg-primary-opacity position-absolute w-100 bottom-0 end-0 mb-0 text-center py-2 text-white">
                                        {{ $tour->tour_time }} {{ $tour->tour_date }}
                                    </p>
                                </div>
                                <h4 class="mt-3"><a href="{{route('tour.visit',$tour->id)}}" class="text-decoration-none fw-bold text-secondary custom-hover">{{ $tour->title }}</a></h4>
                                <p class="fw-bold text-primary">Contributed by {{$tour->user->full_name}}</p>
                                <p>{{ $tour->question }}</p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="" class="btn btn-outline-secondary">{{$tour->category->name}}</a>
                                    @if(Auth::user()->tours->contains($tour->id))
                                    <button class="btn btn-outline-secondary">Purchased</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

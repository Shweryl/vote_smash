@extends('layouts.withNav')

@section('content')
    <div class="container-fluid h-100 px-0" x-data="tourList">
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
                    <template x-for="tour in visibleTours" :key="tour.id">
                        <div class="col-md-4 col-6 mb-4">
                            <div class="card p-4 border border-1 border-secondary shadow h-100 d-flex flex-column">
                                <div class="position-relative">
                                    <a :href="`/tour/${tour.id}/visit`">
                                        <img :src="`/storage/${tour.cover_image}`" class="w-100 object-fit-cover"
                                            height="200" alt="">
                                    </a>
                                    <p
                                        class="bg-primary-opacity position-absolute w-100 bottom-0 end-0 mb-0 text-center py-2 text-white">
                                        <span x-text="formattedTime(tour.tour_time)"></span>
                                        <span x-text="formattedDate(tour.tour_date)"></span>
                                    </p>
                                </div>
                                <h4 class="mt-3">
                                    <a :href="`/tour/${tour.id}/visit`"
                                        class="text-decoration-none fw-bold text-secondary custom-hover">
                                        <span x-text="tour.title"></span>
                                    </a>
                                </h4>
                                <p class="fw-bold text-primary">Contributed by <span
                                        x-text="tour.user.first_name"></span><span x-text="tour.user.last_name"></span></p>
                                <p x-text="tour.question"></p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="" class="btn btn-outline-secondary">Category</a>
                                    {{-- @if (Auth::user()->tours->contains($tour->id)) --}}
                                    <button class="btn btn-outline-secondary" x-show="isPurchased(tour)">Purchased</button>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- Show more button -->
                <div class="text-center">
                    <button x-show="visibleTours.length < allTours.length" @click="loadMore" class="btn btn-primary mt-3">
                        Show More
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tourList', () => ({
                allTours: @json($tours),
                userPurchasedTours: @json($userPurchasedTours),
                visibleTours: [],
                chunkSize: 3,
                loadMore() {
                    let nextChunk = this.allTours.slice(this.visibleTours.length, this.visibleTours
                        .length + this.chunkSize);
                    this.visibleTours.push(...nextChunk);
                },
                init() {
                    this.loadMore();
                },
                isPurchased(tour) {
                    let purchase = this.userPurchasedTours.filter(purchasedTour => tour.id ==
                        purchasedTour.id);
                    if (purchase.length > 0) {
                        console.log(purchase);
                        return true;
                    } else {
                        return false;
                    }
                },

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

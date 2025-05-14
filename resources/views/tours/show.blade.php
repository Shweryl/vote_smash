@extends('layouts.withNav')

@section('content')
    <div class="container-fluid h-100 px-0" x-data="boardData">

        <div class="d-flex justify-content-center">
            <div class="col-md-7">
                <div class="p-4">
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
                        <p>{{ $tour->tour_time }} {{ $tour->tour_date }}</p>
                        <p class="fw-bold text-secondary">$ 1.00 CAD</p>
                    </div>
                    <div style="display: none;" x-show="!startMatch" x-cloak>
                        <p>Tour will start in <span class="text-danger fw-bold ms-2" x-text="display"></span></p>
                    </div>


                    <template x-if="startMatch == 'match1' && match2Status != 'active' ">
                        <div class="">
                            <div class="">
                                <span>User Name : </span>
                                <input style="outline: none" type="text" name=""
                                    class="py-1 px-2 border border-2 border-primary text-primary"
                                    placeholder="Enter your match name" x-model="username" id="">
                            </div>
                            <div class="mt-3">
                                <p class="fw-bold">Tour Questions</p>
                                <template x-for="(question, index) in questions">
                                    <div class="mt-3">
                                        <p x-text="question.question_text"></p>
                                        <template x-for="option in question.options">
                                            <div class="d-flex align-items-center">
                                                <input type="radio" :name="'question' + index"
                                                    x-model="selectedAnswers[question.id]" :value="option">
                                                <span class="ms-2" x-text="option"></span>
                                            </div>
                                        </template>

                                    </div>
                                </template>
                            </div>

                            <button class="btn btn-secondary mt-3" @click="submitMatch1">Submit</button>

                        </div>
                    </template>

                    <template x-if="showMatch1Answers">
                        <div class="bg-info p-4 text-white">
                            <p>Welcome {{ Auth::user()->full_name }}</p>
                            <p>You answer the questions as follows</p>
                            <template x-for="answer in match1Answers">
                                <div class="">
                                    <p x-text="answer.question.question_text" class="mb-0"></p>
                                    <p class="mb-0"><strong>Answers : </strong><span x-text="answer.user_answer"></span></p>
                                </div>
                            </template>

                        </div>
                    </template>

                    <template x-if="showEmptyMatch1Answers">
                        <div class="bg-info p-4 text-white">
                            <p>Welcome {{ Auth::user()->full_name }}</p>
                            <p>You answer the questions as follows</p>
                            <template x-for="question in questions">
                                <div >
                                    <p x-text="question.question_text" class="mb-0"></p>
                                    <p class="mb-0"><strong>Answer :</strong> None </p>
                                </div>
                            </template>

                        </div>
                    </template>


                    <div class="" x-show="match1Count != '' ">
                        <p class="text-danger fw-bold" x-text="match1Count"></p>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('boardData', () => ({
                uptime: '{{ $tour->tour_date }}T{{ $tour->tour_time }}',
                display: '',
                tour: @json($tour),
                timer: null, //waiting room timer before match starch
                match: {}, // record match info from backend
                startMatch: '', //which match the user is in
                questions: [],
                username: '', //username for applicant
                selectedAnswers: {}, //applicant ansers for match1
                match1Count: '', //decreasing count and show it in ui
                match1TargetTime: null, //adding 3 minutes to start_time that applicant joined
                match1_timer: null, // for stopping interval
                showMatch1Answers: localStorage.getItem('showMatch1Answers') || false,
                showEmptyMatch1Answers: localStorage.getItem('showEmptyMatch1Answers') || false,
                match2Status : localStorage.getItem('match2Status') || '',
                match1Answers: JSON.parse(localStorage.getItem('match1Answers')) || [],


                init() {
                    this.startCountdown();
                },



                {{-- Start time countdown section --}}
                startCountdown() {
                    this.updateCountdown();
                    this.timer = setInterval(() => this.updateCountdown(), 1000);
                },

                updateCountdown() {
                    const now = new Date();
                    const target = new Date(this.uptime);
                    let diff = Math.floor((target - now) / 1000);

                    if (diff <= 0) {
                        this.display = 'Countdown complete!';
                        clearInterval(this.timer);
                        this.sendBackendRequest();
                        return;
                    }
                    const days = Math.floor(diff / (24 * 60 * 60));
                    diff %= (24 * 60 * 60);
                    const hours = Math.floor(diff / (60 * 60));
                    diff %= (60 * 60);
                    const minutes = Math.floor(diff / 60);
                    const seconds = diff % 60;
                    this.display =
                        `${days}d : ${this.pad(hours)}h : ${this.pad(minutes)}m : ${this.pad(seconds)}s`;
                },

                pad(num) {
                    return String(num).padStart(2, '0');
                },

                match1countdown() {
                    const now = new Date();
                    const diff = Math.floor((this.match1TargetTime - now) / 1000);

                    if (diff <= 0) {
                        clearInterval(this.match1_timer);
                        this.match1Count =
                            "You are taking more than 3 minutes. This will effect following match time. Submit Now!";
                        return;
                    }

                    const minutes = Math.floor(diff / 60);
                    const seconds = diff % 60;
                    this.match1Count = `${this.pad(minutes)}:${this.pad(seconds)}`;
                },

                async sendBackendRequest() {
                    try {
                        let response = await
                        fetch(`/tour/${this.tour.id}/startMatch`);
                        let data = await response.json();
                        if (data.status == 'success') {
                            this.startMatch = 'match1';

                            this.match = data.match;
                            console.log(this.match);
                            this.questions = data.questions;

                            const baseTime = new Date(this.match.start_time.replace(' ', 'T') +'Z');
                            //const targetTime = new Date(baseTime.getTime() + 3 * 60 * 1000);
                            this.match1TargetTime = new Date(baseTime.getTime() + 3 * 60 * 1000);
                            console.log(this.match1TargetTime);
                            this.match1countdown();
                            this.match1_timer = setInterval(() => this.match1countdown(), 1000);
                        }
                    } catch (error) {
                        console.error('Request failed:', error);
                    }
                },

                async submitMatch1() {
                    if (Object.values(this.selectedAnswers).every(val => !val)) {
                        console.log(this.selectedAnswers);
                        console.log("this worked")
                        const now = new Date();
                        const diff = Math.floor((this.match1TargetTime - now) / 1000);
                        this.showEmptyMatch1Answers = true;
                        localStorage.setItem('showEmptyMatch1Answers', 'true');
                        if (diff <= 0) {
                            this.match2Status = 'active';
                            localStorage.setItem('match2Status', 'active');
                        }
                    } else {
                        console.log(this.selectedAnswers);
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');
                        try {
                            let response = await fetch(`/tour/${this.match.id}/match1/answers`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: JSON.stringify({
                                    answers: this.selectedAnswers,
                                })
                            });
                            let data = await response.json();
                            if (data.status == 'success') {

                                this.match1Answers = data.match1Answers;
                                localStorage.setItem('match1Answers', JSON.stringify(this.match1Answers));
                                // this.showMatch1Answers = true;
                                this.match2Status = 'active';
                                localStorage.setItem('match2Status', 'active');
                                this.showMatch1Answers = true;
                                localStorage.setItem('showMatch1Answers', 'true');
                                console.log(data);
                            }

                        } catch (error) {
                            console.log('Error occur', error);
                        };
                    }
                },

            }))
        })
    </script>
@endpush

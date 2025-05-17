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

                    {{-- not show when user click submit with noo answers or answers --}}
                    <template
                        x-if="startMatch == 'match1' && ( showMatch1Answers ? false : showEmptyMatch1Answers ? false : true)">
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



                    <div class="bg-info p-4 text-white" x-show="showMatch1Answers || showEmptyMatch1Answers">
                        <template x-if="showMatch1Answers">
                            <div class="">
                                <p>Welcome {{ Auth::user()->full_name }}</p>
                                <p>You answer the questions as follows</p>
                                <template x-for="answer in match1Answers">
                                    <div class="">
                                        <p x-text="answer.question.question_text" class="mb-0"></p>
                                        <p class="mb-0"><strong>Answers : </strong><span
                                                x-text="answer.user_answer"></span>
                                        </p>
                                    </div>
                                </template>
                                <div x-show="match2Status == 'active'">
                                    <p class="fw-bold text-success mt-3">This tour began at {{ $tour->tour_time }}
                                        {{ \Carbon\Carbon::parse($tour->tour_date)->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </template>
                        <template x-if="showEmptyMatch1Answers">
                            <div class="">
                                <p>Welcome {{ Auth::user()->full_name }}</p>
                                <p>You answer the questions as follows</p>
                                <template x-for="question in questions">
                                    <div>
                                        <p x-text="question.question_text" class="mb-0"></p>
                                        <p class="mb-0"><strong>Answer :</strong> None </p>
                                    </div>
                                </template>
                                <div x-show="match2Status == 'active'">
                                    <p class="fw-bold text-success mt-3">This tour began at {{ $tour->tour_time }}
                                        {{ \Carbon\Carbon::parse($tour->tour_date)->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </template>

                        <template x-if="showMatch2Answers">
                            <div class="">
                                <p>You have submitted <span x-text="match2Answers.length"></span> mvcs</p>
                                <template x-for="(mvc, index) in match2Answers">
                                    <div class="d-flex">
                                        <p x-text="index+1" class="mb-0"></p>
                                        <div class="ms-2">
                                            <p class="mb-0" x-text="mvc.MVC"></p>
                                            <p class="mb-0" x-show="mvc.confidence_rating">
                                                Confidence Rating : <span x-text="mvc.confidence_rating"></span>%
                                            </p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="match2Answers && match2Answers.length == 0 && match3Status == 'active'">
                            <div class="">
                                <p>You have submitted no MVC.</p>
                            </div>
                        </template>

                    </div>



                    <template class="" x-if="!(match1Count == 'complete')">
                        <p class="text-danger fw-bold" x-text="match1Count"></p>
                    </template>

                    {{-- Match  2 MVC Form --}}
                    <template x-if="match2Status == 'active' && showMatch2Answers == false && match3Status != 'active'">
                        <div class="card border border-secondary mt-4 p-4">
                            <template x-for="(mvcInput, index) in mvcs" :key="index">
                                <div class="col-md-8 mb-4">
                                    <h3 class="fw-bold text-primary">Enter MVC #<span x-text="index+1"></span></h3>
                                    <input type="text" x-model="mvcInput.mvc" class="form-control"
                                        :class="{ 'border-danger': !mvcInput.mvc || mvcInput.mvc.trim() === '' }"
                                        placeholder="Your first MVC is free. Subsequent MVCs are $0.25 each.​" required>
                                    <input type="number" x-model="mvcInput.confidence_rating" placeholder="​"
                                        class="form-control mt-3" min="1" max="100">
                                    <small class="text-black-50">$0.10 to include Confidence Rating (1 to 100) for your
                                        MVC</small>
                                </div>
                            </template>

                            <div class="mb-3">
                                <button class="btn btn-outline-secondary" @click="addMVCBox">Add Another MVC</button>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-secondary" @click="submitMVC">Submit MVC</button>
                            </div>
                        </div>
                    </template>

                    <template class="" x-if="!(match2Count == 'complete')">
                        <p class="text-danger fw-bold" x-text="match2Count"></p>
                    </template>

                    <template x-if="match3Status == 'active' && allmvcs && allmvcs.length >= 1">
                        <div class="mt-4 row">
                            <template x-for="tourmvc in allmvcs">
                                <div class="col-md-4 mb-3 ">
                                    <div class="card border border-secondary p-3 h-100 flex flex-column">
                                        <p class="mb-0" x-text="tourmvc.MVC"></p>
                                        <span style="width: 70px;" x-text="tourmvc.confidence_rating + ' %'"
                                            class="py-1 px-2 border border-secondary text-center mt-3 rounded"></span>
                                        <p class="mb-2 text-black-50"><small
                                                x-text="fullname(tourmvc.user.first_name, tourmvc.user.last_name)"></small>
                                        </p>
                                        <div class="mt-auto">
                                            <button @click="submitVote(tourmvc.id, 'Agree')" class="btn w-100 mb-2"
                                                :class="hasVoted(tourmvc.votes, 'Agree') ? 'btn-secondary' :
                                                    'btn-outline-secondary'">
                                                Agree <span x-text="countAgree(tourmvc.votes)">0</span>
                                            </button>
                                            <button @click="submitVote(tourmvc.id, 'Disagree')" class="btn w-100 mb-2"
                                                :class="hasVoted(tourmvc.votes, 'Disagree') ? 'btn-secondary' :
                                                    'btn-outline-secondary'">
                                                Disagree <span x-text="countDisagree(tourmvc.votes)">0</span>
                                            </button>
                                            <button @click="submitVote(tourmvc.id, 'Improvement')" class="btn w-100 mb-2"
                                                :class="hasVoted(tourmvc.votes, 'Improvement') ? 'btn-secondary' :
                                                    'btn-outline-secondary'">
                                                Need Improvements <span x-text="countInprovement(tourmvc.votes)">0</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template class="" x-if="!(match3Count == 'complete')">
                        <p class="text-danger fw-bold" x-text="match3Count"></p>
                    </template>
                </div>


            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('boardData', () => ({
                currentUser: @json(Auth::id()),
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
                showMatch1Answers: false,
                showEmptyMatch1Answers: false,
                match2Status: '',
                match1Answers: [],
                match2TargetTime: null,
                match2Count: '',
                match2_timer: null,
                match2Answers: [],
                showMatch2Answers: false,
                match3Status: '',
                match3TargetTime: null,
                match3Count: '',
                match3_timer: null,
                match3resultSent: false,
                // match3Answers: [],
                // showMatch3Answers: false,
                allmvcs: [],

                mvcs: [{
                    mvc: '',
                    confidence_rating: null,
                }],


                init() {
                    this.startCountdown();
                },



                {{-- Start time countdown section --}}
                startCountdown() {
                    //this.updateCountdown();
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

                            console.log(this.match);

                            //when page is refreshed
                            if (this.match.match1_answers && this.match.match1_answers.length > 0) {
                                this.match1Answers = this.match.match1_answers;
                                this.showMatch1Answers = true;

                                // this.match2Status = 'active';
                            }

                            if (localStorage.getItem(`showEmptyMatch1Answers${this.match.id}`)) {
                                this.showEmptyMatch1Answers = true;
                                console.log("empty match1 answers work", this
                                    .showEmptyMatch1Answers);
                            }

                            if (this.match.mvcs && this.match.mvcs.length > 0) {
                                this.match2Answers = this.match.mvcs;
                                this.showMatch2Answers = true;
                                // this.match2Status = 'active';
                            }



                            const baseTime = new Date(this.uptime);
                            //const targetTime = new Date(baseTime.getTime() + 3 * 60 * 1000);
                            this.match1TargetTime = new Date(baseTime.getTime() + 3 * 60 * 1000);
                            //console.log(this.match1TargetTime);
                            this.match1countdown();
                            this.match1_timer = setInterval(() => this.match1countdown(), 1000);
                        }
                    } catch (error) {
                        console.error('Request failed:', error);
                    }
                },

                match1countdown() {
                    const now = new Date();
                    const diff = Math.floor((this.match1TargetTime - now) / 1000);

                    if (diff <= 0 && (this.showMatch1Answers || this.showEmptyMatch1Answers)) {
                        clearInterval(this.match1_timer);
                        console.log("match1 is complete");

                        this.match2Status = 'active';
                        this.match1Count = 'complete';

                        const baseTime = new Date(this.uptime);
                        this.match2TargetTime = new Date(baseTime.getTime() + 10 * 60 * 1000);
                        this.match2countdown();
                        this.match2_timer = setInterval(() => this.match2countdown(), 1000);
                        //localStorage.setItem(`match2Status${this.match.id}`, 'active');
                    } else if (diff <= 0) {

                        this.match1Count =
                            "You are taking more than 3 minutes. This will effect following match time. Submit Now!";

                    } else {
                        const minutes = Math.floor(diff / 60);
                        const seconds = diff % 60;
                        this.match1Count = `${this.pad(minutes)}:${this.pad(seconds)}`;
                    }


                },

                match2countdown() {
                    const now = new Date();
                    const diff = Math.floor((this.match2TargetTime - now) / 1000);

                    if (diff <= 0 && this.showMatch2Answers) {
                        clearInterval(this.match2_timer);
                        console.log("match2 is successfully complete");

                        this.match3Status = 'active';
                        this.match2Count = 'complete';
                        this.allmvcs = this.tour.mvcs;
                        console.log(this.allmvcs);

                        const baseTime = new Date(this.uptime);
                        this.match3TargetTime = new Date(baseTime.getTime() + 55 * 60 * 1000);
                        this.match3countdown();
                        this.match3_timer = setInterval(() => this.match3countdown(), 1000);

                    } else if (diff <= 60 && diff > 0) {
                        const minutes = Math.floor(diff / 60);
                        const seconds = diff % 60;
                        this.match2Count = `${this.pad(minutes)}:${this.pad(seconds)}`;
                        if (this.match2Answers && this.match2Answers.length >= 1) {
                            this.match2Count = this.match2Count;
                        } else {
                            this.match2Count = this.match2Count + " " + "(" +
                                "Hurry up! your mvc will not be counted if the time is up." + ")";
                        }


                    } else if (diff <= 0) {
                        clearInterval(this.match2_timer);
                        console.log("match2 is complete");
                        this.match3Status = 'active';
                        this.match2Count = 'complete';

                        //console.log(this.tour.mvcs);

                        this.allmvcs = this.tour.mvcs;

                        const baseTime = new Date(this.uptime);
                        this.match3TargetTime = new Date(baseTime.getTime() + 55 * 60 * 1000);
                        this.match3countdown();
                        this.match3_timer = setInterval(() => this.match3countdown(), 1000);

                    } else {
                        const minutes = Math.floor(diff / 60);
                        const seconds = diff % 60;
                        this.match2Count = `${this.pad(minutes)}:${this.pad(seconds)}`;
                    }


                },

                match3countdown() {
                    const now = new Date();
                    const diff = Math.floor((this.match3TargetTime - now) / 1000);
                    if (diff <= 0) {
                        clearInterval(this.match3_timer);
                        this.match3_timer = null;
                        console.log("match3 is successfully complete");
                        if (!localStorage.getItem(`resultSent${this.match.id}`)) {
                            console.log("match3 is successfully complete");
                            this.sendResultRequest();
                            this.match3resultSent = true; // ✅ Mark as sent
                            localStorage.setItem(`resultSent${this.match.id}`, true);
                        }
                        //this.match3Status = 'active';
                        this.match3Count = 'match complete';


                    } else {
                        const minutes = Math.floor(diff / 60);
                        const seconds = diff % 60;
                        this.match3Count = `${this.pad(minutes)}:${this.pad(seconds)}`;
                    }
                },

                async submitMatch1() {
                    if (Object.values(this.selectedAnswers).every(val => !val)) {

                        const now = new Date();
                        const diff = Math.floor((this.match1TargetTime - now) / 1000);
                        this.showEmptyMatch1Answers = true;
                        localStorage.setItem(`showEmptyMatch1Answers${this.match.id}`, 'true');
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

                                this.match1Answers = data.match.match1_answers;

                                // this.match2Status = 'active';

                                this.showMatch1Answers = true;

                                console.log(data);
                            }

                        } catch (error) {
                            console.log('Error occur', error);
                        };
                    }
                },

                addMVCBox() {
                    this.mvcs.push({
                        mvc: '',
                        confidence_rating: 0,
                    })
                },

                async submitMVC() {
                    const allValid = this.mvcs.every(
                        mvc => mvc.mvc && mvc.mvc.trim() !== ''
                    );

                    if (!allValid) {
                        alert('All MVC fields must be filled.');
                        return;
                    }
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');
                    try {
                        let response = await fetch(`/match/${this.match.id}/mvc`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                mvcs: this.mvcs,
                            })
                        })

                        let data = await response.json();
                        if (data.status == 'success') {
                            this.match2Answers = data.match.mvcs;
                            this.showMatch2Answers = true;
                        }
                    } catch (error) {
                        console.log(error);
                    }
                },

                fullname(first, last) {
                    return first + ' ' + last;
                },

                async submitVote(mvc, comment) {
                    try {
                        let response = await fetch(`/mvc/${mvc}/vote/${comment}`);
                        let data = await response.json();
                        if (data.status == 'success') {
                            this.allmvcs = data.tour.mvcs;
                            console.log("this success");
                        }
                    } catch (error) {
                        console.log(error);
                    }
                },

                countAgree(votes) {
                    let agrees = votes.filter((vote) => vote.comment == 'Agree');
                    return agrees.length;
                },

                countDisagree(votes) {
                    let disagrees = votes.filter((vote) => vote.comment == 'Disagree');
                    return disagrees.length;
                },

                countInprovement(votes) {
                    let inprovements = votes.filter((vote) => vote.comment == 'Improvement');
                    return inprovements.length;
                },

                async sendResultRequest() {
                    try {
                        console.log("this worked");
                        let response = await fetch(`/tour/${this.tour.id}/result`);
                        let data = await response.json();

                        if (data.status == "success") {
                            console.log(data);
                        }
                    } catch (error) {
                        console.log(error);
                    }
                },

                hasVoted(votes, comment) {
                    return votes.some(vote => vote.user_id === this.currentUser && vote.comment ===
                        comment);
                }

            }))
        })
    </script>
@endpush

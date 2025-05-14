@extends('layouts.withNav')

@section('content')
    <div class="container h-100" x-data="tourData" x-init="console.log('I\'m being initialized!')">
        <div class="row justify-content-center g-5">
            <div class="col-md-5 me-4">
                <div class="card py-4 px-5">
                    <h3 class="fw-bold text-secondary text-center mb-4">Create Tour Model</h3>
                    <form action="{{ route('tour.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title" class="mb-3">Title</label>

                            <input x-model="title" id="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ old('title') }}" required placeholder="Enter title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="title" class="mb-3">Select Category</label>

                            <select x-model="category" name="category_id" class="form-select" id="">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group mb-3">
                            <label for="title" class="mb-3">Question</label>

                            <textarea x-model="question" name="question" class="form-control" id="" cols="" rows="2"
                                placeholder="Enter Question" @error('question') is-invalid @enderror">{{ old('title') }}</textarea>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tour_date" class="mb-3">Tour Date</label>

                            <input x-model='eventDate' id="tour_date" type="date"
                                class="form-control @error('tour_date') is-invalid @enderror" name="tour_date"
                                value="{{ old('tour_date') }}" required>

                            @error('tour_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tour_time" class="mb-3">Tour Time</label>

                            <input x-model="eventTime" id="tour_time" type="time"
                                class="form-control @error('tour_time') is-invalid @enderror" name="tour_time"
                                value="{{ old('tour_time') }}" required>

                            @error('tour_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="cover_image" class="mb-3">Tour Image</label>

                            <input id="cover_image" type="file" @change="changeImg"
                                class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                                value="{{ old('cover_image') }}" required>

                            @error('cover_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="video_link" class="mb-3">Video Link</label>

                            <input id="video_link" type="text"
                                class="form-control @error('video_link') is-invalid @enderror" name="video_link"
                                value="{{ old('video_link') }}" required placeholder="Enter Video Link">

                            @error('video_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="live_event_link" class="mb-3">Live Event Link</label>

                            <input id="live_event_link" type="text"
                                class="form-control @error('live_event_link') is-invalid @enderror" name="live_event_link"
                                value="{{ old('live_event_link') }}" required placeholder="Enter Live Event Link">

                            @error('live_event_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- questions inputs --}}
                        <div class="">
                            <template x-for="(question, qIndex) in questions" :key="qIndex">
                                <div class="mb-3 border p-4 rounded">
                                    <label class="d-block fw-bold">Question <span x-text="qIndex + 1"></span>:</label>
                                    <input type="text" x-model="question.text" class="w-100 border rounded p-2 mb-2"
                                        placeholder="Enter your question here" required>

                                    <template x-for="(option, index) in question.options" :key="index">
                                        <input style="width : 45%" type="text" x-model="question.options[index]"
                                            class="border rounded p-2 mb-1 me-1" :placeholder="`Enter option ${index+1}`"
                                            required>
                                    </template>
                                </div>
                            </template>

                            <!-- Add Question Button -->
                            <button type="button" @click="addQuestion"
                                class="btn btn-outline-secondary px-4 py-2 rounded mb-4">
                                Add Question
                            </button>

                            <!-- Hidden Payload -->
                            <input type="hidden" name="questions" :value="JSON.stringify(questions)">

                        </div>

                        <button class="btn btn-secondary mb-3" type="submit">Create Tour</button>
                    </form>
                </div>
            </div>
            <div class="col-md-5 ms-4">
                <h2 class="fw-bold text-secondary text-center mb-4">Preview</h2>
                <div class="card p-4 border border-1 border-secondary shadow">
                    <div class="position-relative">
                        <img :src="cover_img" class="w-100 object-fit-cover" height="300" alt="">
                        <p
                            class="bg-primary-opacity position-absolute w-100 bottom-0 end-0 mb-0 text-center py-2 text-white">
                            <span x-text="previewTime"></span>
                            <span x-text="previewDate"></span>
                        </p>
                    </div>
                    <h3 class="fw-bold text-secondary mt-3" x-text="previewTitle"></h3>
                    <p>Contributed by <span x-text="hostName" class="text-secondary fw-bold"></span></p>
                    <p class="" x-text="previewQuestion">Tour Questions something you want to debate?</p>
                    <div class="">
                        <a href="" class="btn btn-outline-secondary"
                            x-text="categories[category - 1].name">Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tourData', () => ({
                title: '',
                hostName: {{ Js::from(Auth::user()->full_name) }},
                cover_img: '/images/preview_demo.jpg',
                category: '1',
                question: '',
                questions: [{
                    text: '',
                    options: ['', '', '', '']
                }],
                eventDate: '',
                eventTime: '00:00',
                categories: @js($categories),

                get previewTitle() {
                    if (this.title.length > 0) {
                        return this.title
                    } else {
                        return "Enter a title for your tour."
                    }
                },

                get previewQuestion() {
                    if (this.question.length > 0) {
                        return this.question
                    } else {
                        return "Enter question for your tour."
                    }
                },

                get previewTime() {
                    const [hour, minute] = this.eventTime.split(':');
                    const date = new Date();
                    date.setHours(hour, minute);

                    return date.toLocaleTimeString([], {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                },

                get previewDate() {
                    if (!this.eventDate) {
                        return '00/00/00'
                    } else {
                        const date = new Date(this.eventDate);
                        return date.toLocaleDateString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric'
                        });
                    }

                },

                changeImg(event) {
                    let imageFile = URL.createObjectURL(event.target.files[0]);
                    if (imageFile) {
                        this.cover_img = imageFile;
                    }
                },

                addQuestion() {
                    this.questions.push({
                        text: '',
                        options: ['', '', '', '']
                    });
                },
            }))


        })
    </script>
@endpush

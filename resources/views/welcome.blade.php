<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="vh-100">
        <nav class="navbar navbar-expand-md navbar-light py-0">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo_small.png') }}" height="80" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- Authentication Links -->

                        @if (Route::has('login'))
                            <li class="nav-item ">
                                <a class="nav-link fw-bold text-secondary"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif


                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 h-auto">
            <div class="container-fluid h-100">
                <div class="row ">
                    <div class="banner d-flex justify-content-center">
                        <div class="col-md-6 text-center px-4">
                            <h2 class="fw-bold text-secondary">Gamify the consensus-reaching Process</h2>
                            <p class="">You may retrieve a request header from the Illuminate\Http\Request
                                instance using the
                                header method. If the header is not present on the request, null will be returned.
                                However, the
                                header method accepts an optional second argument that will be returned
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4">Sign Up</a>
                        </div>
                    </div>

                    {{-- carousel slider --}}
                    <div class="d-flex justify-items-center mt-5">
                        <div class="w-100">
                            <div class="swiper col-md-6">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide text-center"><img src="{{ asset('images/slider1.jpg') }}"
                                            height="150" />
                                    </div>
                                    <div class="swiper-slide text-center"><img src="{{ asset('images/slider2.png') }}"
                                            height="150" /></div>
                                    <div class="swiper-slide text-center"><img src="{{ asset('images/slider3.jpg') }}"
                                            height="150" /></div>
                                    <div class="swiper-slide text-center"><img src="{{ asset('images/slider4.jpg') }}"
                                            height="150" /></div>
                                    <div class="swiper-slide text-center"><img src="{{ asset('images/slider1.jpg') }}"
                                            height="150" /></div>
                                    <div class="swiper-slide text-center"><img src="{{ asset('images/slider2.png') }}"
                                            height="150" /></div>
                                </div>

                            </div>
                            <div class="custom-swiper-nav">
                                <div class="custom-button-prev">&#x25C0;</div> <!-- ◀ -->
                                <div class="custom-button-next">&#x25B6;</div> <!-- ▶ -->
                            </div>
                        </div>
                    </div>
                    <div class="info-section d-flex justify-content-center mt-5">
                        <div class="col-md-6 d-flex align-items-center px-4">
                            <div class="col-md-6 me-5">
                                <h2>Get started easily with personalized tour</h2>
                                <p>y default Swiper exports only core version without additional modules (like Navigation, Pagination, etc.). So you need to import and configure them too</p>
                                <a href="{{route('login')}}" class="btn btn-secondary">Learn More</a>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('images/slider3.jpg')}}" class="w-100" alt="">
                            </div>
                        </div>
                    </div>

                    {{-- More text section  --}}
                    <div class="d-flex justify-content-center ">
                        <div class="col-md-6 text-center bg-secondary p-4 ">
                            <p class="text-white">Have you put brainstorming on hold since your team went remote? Or perhaps you’re struggling to find a way to problem solve if you’re not sitting around a big whiteboard? Not to worry, we’re here to help!</p>
                            <a href="{{route('register')}}" class="btn btn-outline-light">Sign Up</a>
                        </div>
                    </div>
                    {{-- footer --}}
                    <div class="d-flex justify-content-center mt-5">
                        <div class="text-center">
                            <div class="logos">
                                <span>facebook</span>
                                <span>instagram</span>
                                <span>linkin</span>
                            </div>
                            <div class="">
                                <span>Solutions |</span>
                                <span>Products |</span>
                                <span>Terms & conditions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            slidesPerView: 4,
            // spaceBetween: 2,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.custom-button-next',
                prevEl: '.custom-button-prev',
            },
            speed: 600,
        });
    </script>္
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#07030c">
    <meta name="theme-color" content="#07030c">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/' . site('favicon')) }}">
    <link rel="icon" href="{{ asset('assets/images/' . site('favicon')) }}">
    <title> {{ $page_title }} | {{ site('name') }}</title>
    <meta name="author" content="support@rescron.com">
    <meta name="description" content="{{ $short_description }}">
    <meta property="og:url" content="{{ request()->url }}">
    <meta property="og:title" content="{{ $page_title }} | {{ site('name') }}">
    <meta property="og:description" content="{{ $short_description }}">
    <meta property="og:image" content="{{ asset('assets/images/' . site('cover')) }}">
    <meta name="robots" content="{{ site('robot') }}">
    <style>
        .wave {
            width: 5px;
            height: 100px;
            background: linear-gradient(45deg, rgb(168, 85, 247), rgb(249, 115, 22));
            margin: 10px;
            animation: wave 1s linear infinite;
            border-radius: 20px;
        }

        .wave:nth-child(2) {
            animation-delay: 0.1s;
        }

        .wave:nth-child(3) {
            animation-delay: 0.2s;
        }

        .wave:nth-child(4) {
            animation-delay: 0.3s;
        }

        .wave:nth-child(5) {
            animation-delay: 0.4s;
        }

        .wave:nth-child(6) {
            animation-delay: 0.5s;
        }

        .wave:nth-child(7) {
            animation-delay: 0.6s;
        }

        .wave:nth-child(8) {
            animation-delay: 0.7s;
        }

        .wave:nth-child(9) {
            animation-delay: 0.8s;
        }

        .wave:nth-child(10) {
            animation-delay: 0.9s;
        }

        @keyframes wave {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }
    </style>

    @stack('css')


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    {{-- material icon cdn --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- sweet alert css --}}

</head>

<body class="ts-gray-1 text-[#ebedf2] rescron-font h-screen overflow-hidden">
    @if (site('preloader') == 1)
        <div class="preloader w-full z-50 fixed top-0 left-0 ts-gray-1">
            <div class="w-full flex items-center justify-center bottom-0 h-screen">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
            </div>

        </div>
    @endif
    {{-- header starts here --}}
    <header class="w-full flex justify-between items-center px-5 md:px-10 py-2 ts-gray-1" id="fixed-header">
        <div class="flex items-center justify-start">
            <a href="{{ url('/') }}"><img class="w-44" src="{{ asset('assets/images/' . site('logo_rec')) }}"
                    alt="Logo"></a>
        </div>
        <div class="md:w-3/4">
            <div class="w-full flex justify-end items-center space-x-2 hidden lg:flex">
                <div class="flex ">
                    <div class="w-full pr-12 flex items-center space-x-5 text-lg">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('about') }}">About Us</a>
                        <a href="{{ route('pricing') }}">Ai Bots</a>
                        <a href="{{ route('trades') }}">Live AI Trades</a>
                        <a href="{{ route('tos') }}">TOS</a>
                        <a href="{{ route('contact') }}">Contact</a>
                        <a href="{{ route('faqs') }}">FAQ</a>

                    </div>
                </div>
                <div class="flex items-center space-x-2 justify-end">
                    <a class="rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-2 py-1 hover:scale-110 transition-all"
                        href="{{ route('user.login') }}">Sign In</a>
                    <a class="ts-gray-3 rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-2 py-1 hover:scale-110 transition-all"
                        href="{{ route('user.register') }}">
                        <span>Sign Up</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="lg:hidden">
                <a role="button" class="mobile-menu-trigger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                        <path
                            d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    @yield('contents')

    {{-- counter --}}
    <section class="w-full px-5 md:px-20 mt-10">
        <div class="w-full flex justify-center">
            <div class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="p-3">
                        <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                            <div>
                                <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                    src="{{ asset('assets/images/users.png') }}" alt="">
                            </div>
                            <div class="rescron-font-bold">
                                <h4 class="">
                                    Users
                                </h4>
                                <h4 class="text-2xl ">
                                    3.5K+
                                </h4>
                            </div>
                        </div>
                    </div>


                    <div class="p-3">
                        <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                            <div>
                                <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                    src="{{ asset('assets/images/hows/2.png') }}" alt="">
                            </div>
                            <div class="rescron-font-bold">
                                <h4 class="">
                                    Deposits
                                </h4>
                                <h4 class="text-2xl ">
                                    {{ site('currency') }}5.5M+
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="p-3">
                        <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                            <div>
                                <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                    src="{{ asset('assets/images/hows/4.png') }}" alt="">
                            </div>
                            <div class="rescron-font-bold">
                                <h4 class="">
                                    Withdrawals
                                </h4>
                                <h4 class="text-2xl ">
                                    {{ site('currency') }}10.2M+
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="p-3">
                        <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                            <div>
                                <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                    src="{{ asset('assets/images/countries.png') }}" alt="">
                            </div>
                            <div class="rescron-font-bold">
                                <h4 class="">
                                    Countries Supported
                                </h4>
                                <h4 class="text-2xl ">
                                    200+
                                </h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- footer --}}
    <footer class="w-full text-gray-500">

        <div class="h-32 border-b border-slate-800 mt-10"></div>

        <div class=" px-5 md:px-20 mt-10">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="w-full">
                    <h3 class="text-lg rescron-font-bold text-[#ebedf2]">
                        <span class="border-b border-slate-800 mb-2">Company</span>
                    </h3>
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('about') }}">Our Vision</a></li>
                        <li><a href="{{ route('about') }}">Our Mission</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="w-full">
                    <h3 class="text-lg rescron-font-bold text-[#ebedf2]">
                        <span class="border-b border-slate-800 mb-2">Resources</span>
                    </h3>
                    <ul>
                        <li><a href="{{ route('tos') }}">TOS</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li>Community</li>
                        <li>
                        <li><a href="{{ route('faqs') }}">FAQ</a></li>
                        </li>

                    </ul>
                </div>
                <div class="w-full">
                    <h3 class="text-lg rescron-font-bold text-[#ebedf2]">
                        <span class="border-b border-slate-800 mb-2">Contact Us</span>
                    </h3>
                    <ul>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i> {{ site('address') }}, {{ site('city') }},
                            {{ site('state') }}, {{ site('country') }}
                        </li>
                        <li>
                            <i class="bi bi-telephone-fill"></i> {{ site('phone') }}
                        </li>
                        <li>
                            <i class="bi bi-envelope-fill"></i> {{ site('email') }}
                        </li>

                    </ul>
                </div>
                <div class="w-full">
                    <a href="{{ url('/') }}"><img class="w-44"
                            src="{{ asset('assets/images/' . site('logo_rec')) }}" alt="Logo"></a>

                    <p class="text-green-500 text-xs"> <i class="bi bi-dot"></i> All Servers Operational</p>


                    <p class="w-full flex justify-start items-center space-x-3 mt-2 text-sm">
                        <a href="{{ site('facebook') }}"><i class="bi bi-facebook"></i></a>
                        <a href="{{ site('twitter') }}"><i class="bi bi-twitter"></i></a>
                        <a href="{{ site('instagram') }}"><i class="bi bi-instagram"></i></a>
                        <a href="{{ site('linkedin') }}"><i class="bi bi-linkedin"></i></a>
                        <a href="{{ site('youtube') }}"><i class="bi bi-youtube"></i></a>
                        <a href="{{ site('pinterest') }}"><i class="bi bi-pinterest"></i></a>
                        <a href="{{ site('snapchat') }}"><i class="snapchat"></i></a>
                        <a href="{{ site('tiktok') }}"><i class="tiktok"></i></a>
                        <a href="{{ site('reddit') }}"><i class="reddit"></i></a>
                        <a href="{{ site('whatsapp') }}"><i class="reddit"></i></a>
                    </p>

                </div>
            </div>
        </div>

        <div class="h-24"></div>

    </footer>

    {{-- mobile menu --}}
    <div class="w-full fixed top-0 left-0 z-50 transition hidden" id="mobile-menu">
        <div class="w-full h-screen flex justify-center items-center relative overflow-hidden ts-gray-1">
            <div class="w-full flex justify-center relative items-center">
                <div class="w-3/4 md:w-1/2 relative h-screen">
                    <div class="w-full flex justify-start items-center p-5">

                        <a role="button" class="mobile-menu-trigger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                            </svg>
                        </a>


                    </div>
                    <div class="w-full grid-cols-1 gap-5 text-2xl capitalize">
                        <div class="flex justify-center py-5"><a href="{{ url('/') }}">Home</a></div>
                        <div class="flex justify-center py-5"><a href="{{ url('about') }}">About US</a></div>
                        <div class="flex justify-center py-5"><a href="{{ route('pricing') }}">Ai Bots</a></div>
                        <div class="flex justify-center py-5"><a href="{{ route('trades') }}">Live AI Trades</a>
                        </div>
                        <div class="flex justify-center py-5"><a href="{{ route('tos') }}">TOS</a></div>
                        <div class="flex justify-center py-5"><a href="{{ route('contact') }}">Contact</a></div>
                        <div class="flex justify-center py-5"><a href="{{ route('faqs') }}">FAQ</a></div>

                        <div class="flex justify-center py-5 space-x-2"><a
                                class="rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                                href="{{ route('user.login') }}">Sign In</a>

                            <a class="px-2 ts-gray-3 rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                                href="{{ route('user.register') }}">
                                <span>Sign Up</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>


    {{-- cookie consent --}}
    <div class="w-full fixed z-50 bottom-0 left-0 hidden" id="cookie-consent">
        <div class="w-full bg-purple-500 p-5">
            <div class="w-full grid grid-cols-1 gap-3  md:flex space-x-2 justify-center items-center">
                <p class="text-center">We use cookies to tailor your experience on {{ site('name') }}. Learn more in
                    our <a href="{{ route('privacy') }}">privacy policy</a></p>
                <div class="text-center">
                    <a id="consented"
                        class="ts-gray-3 rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-2 py-1 hover:scale-110 transition-all"
                        role="button">
                        <span>Accept Cookies</span>

                    </a>
                </div>
            </div>
        </div>
    </div>


    {{-- all script placements --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- cookie --}}
    <script>
        function setCookie(cookieName, cookieValue) {
            var expirationDate = new Date();
            expirationDate.setFullYear(expirationDate.getFullYear() + 10); // Set expiration date to 10 years from now

            var cookieString = cookieName + '=' + cookieValue + '; expires=' + expirationDate.toUTCString() + '; path=/';

            document.cookie = cookieString;
        }


        $('#consented').on('click', function(e) {
            e.preventDefault();
            setCookie('cookie-consent', true);
            $('#cookie-consent').addClass('hidden');
        });
    </script>

    @yield('scripts')

    @stack('scripts')

    {{-- hide preloader --}}
    <script>
        window.onload = function() {
            $('.preloader').fadeOut(100);
            $('body').remove('h-screen').removeClass('overflow-hidden');
            // Check if the "cookie-consent" cookie exists
            if (!document.cookie.includes('cookie-consent')) {
                $('#cookie-consent').removeClass('hidden');
            }
        };
    </script>

    {{-- mobile menu trigger --}}
    <script>
        var mobileMenu = $('#mobile-menu');
        $(document).on('click', '.mobile-menu-trigger', function(e) {
            e.preventDefault();
            mobileMenu.toggleClass('hidden');
        });
    </script>




    {{-- fix and shrink header --}}
    <script>
        // scroll
        window.addEventListener('scroll', function() {
            const fixedHeader = document.getElementById('fixed-header');
            const scrollPosition = window.scrollY;

            // Adjust the scroll threshold according to your preference
            const scrollThreshold = 100;

            if (scrollPosition >= scrollThreshold) {
                fixedHeader.classList.add('fixed');
                fixedHeader.classList.add('z-40');
                fixedHeader.classList.add('border-b');
                fixedHeader.classList.add('border-slate-800');


            } else {
                fixedHeader.classList.remove('fixed');
                fixedHeader.classList.remove('z-40');
                fixedHeader.classList.remove('border-b');
                fixedHeader.classList.remove('border-slate-800');


            }

        });
    </script>

    {{-- livechat --}}
    {!! json_decode(site('livechat')) !!}


</body>

</html>

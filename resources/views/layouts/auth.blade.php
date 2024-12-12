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
    <title>{{ $page_title }} | {{ site('name') }}</title>
    <meta name="author" content="support@rescron.com">
    <meta name="description" content="{{ site('seo_description') }}">
    <meta property="og:url" content="{{ request()->url }}">
    <meta property="og:title" content="{{ $page_title }} | {{ site('name') }}">
    <meta property="og:description" content="{{ site('seo_description') }}">
    <meta property="og:image" content="{{ asset('assets/images/' . site('cover')) }}">
    <meta name="robots" content="noindex">
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
    <link rel="stylesheet" href="{{ asset('assets/css/gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    {{-- material icon cdn --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- sweet alert css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

</head>

<body class="ts-gradient-dark w-screen h-screen overflow-y-hidden scrollbar">
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
    <div class="w-full h-full px-5">
        <div class="flex justify-center w-full h-screen items-center">
            <div class="w-full md:w-3/4 lg:w-2/6 ts-gray-2 py-3 rounded-lg shadow">
                <div class="flex justify-center items-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/' . site('logo_square')) }}" alt="Logo"
                        class="theme1-card-logo"></a>
                </div>
                <h3 class="text-xl text-center font-bold text-gray-300" id="page-title">
                    {{ $page_title }}
                </h3>


                <div class="px-4 lg:px-10 mt-6 space-y-6">
                    <p class="bg-green-500 text-gray-300 p-1 rounded-lg text-xs text-center hidden" id="noticeMsg"></p>
                </div>



                @yield('contents')




            </div>
        </div>
    </div>

    {{-- all script placements --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Include SweetAlert2 JavaScript file --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/scripts/main.js') }}"></script>
    @yield('scripts')

    {{-- hide preloader --}}
    <script>
        window.onload = function() {
            $('.preloader').fadeOut(100);
            $('body').remove('h-screen').removeClass('overflow-hidden');
        };
    </script>

    {{-- livechat --}}
    {!! json_decode(site('livechat')) !!}

    

</body>

</html>

@php
    
    $page_title = 'About ' . site('name');
    $short_description = site('name') . ' uses advanced Ai robots trained on extensive trading data and algorithms to analyze market trends and execute profitable trades with high precision.';
    
@endphp

{{-- layout --}}
@extends('layouts.front')





@section('contents')
    {{-- breadcrumb --}}
    @include('pages.breadcrumb')

    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center">
            <div class="w-full  md:w-3/4 grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>
    
                        </div>
    
    
                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Revolutionizing the World of Trading</h2>
                    <h1 class="text-6xl rescron-font-bold">Welcome to {{ site('name') }}</h1>
                    <p class="text-xl text-gray-500 mt-5">
                        At {{ site('name') }} we are pioneers in the world of financial technology. Our mission is to empower
                        traders, both novice and seasoned, with a powerful yet user-friendly platform that simplifies the
                        complexities of trading. With our advanced AI robots, extensively trained on extensive trading data and
                        cutting-edge algorithms, we offer an unparalleled trading experience.
                    </p>
    
                    <div class="flex items-center space-x-3 justify-start pb-10 mt-10">
                        <a class="rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                            href="{{ route('user.login') }}">
                            <span>Sign In</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a class="bg-purple-500 rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                            href="{{ route('user.register') }}">
                            <span>Sign Up</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
    
    
    
    
    
    
                </div>
                <div class="w-full">
                    
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/1.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
                <div class="w-full sm:hidden">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/2.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
    
                <div class="">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>
    
                        </div>
    
    
                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Pushing Boundaries in Trading Technology</h2>
                    <h1 class="text-6xl rescron-font-bold">Leading with Innovation</h1>
                    <p class="text-xl text-gray-500 mt-5">
                        Innovation drives us. We have harnessed the power of artificial intelligence and machine learning to
                        create a trading ecosystem that adapts and evolves in real-time. Our AI robots analyze market trends
                        with high precision, ensuring that every trade executed is strategically aligned for profitability.
                    </p>
                    
    
    
    
    
    
    
                </div>
    
                <div class="w-full md:hidden">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/2.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
                <div class="">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>
    
                        </div>
    
    
                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Powering Your Success with AI</h2>
                    <h1 class="text-6xl rescron-font-bold">The Technology Behind {{ site('name') }}</h1>
                    <p class="text-xl text-gray-500 mt-5">
                        Our technology is the backbone of {{ site('name') }}. We have invested extensively in building a
                        sophisticated
                        platform that can handle the intricacies of today's financial markets. Our AI robots are at the heart of
                        this technology, constantly learning and evolving to stay ahead of market shifts.
                    </p>
    
                    
    
    
    
    
    
    
                </div>
    
                <div class="w-full ">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/3.png') }}" alt="">
                    </div>
                </div>
    
                <div class="w-full sm:hidden">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/4.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
                <div class="">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>
    
                        </div>
    
    
                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Experienced Minds at Work</h2>
                    <h1 class="text-6xl rescron-font-bold">The {{ site('name') }} Team </h1>
                    <p class="text-xl text-gray-500 mt-5">
                        Behind every successful technology is a team of dedicated experts. Our team is a fusion of seasoned
                        traders, data scientists, and technologists who bring a wealth of knowledge and experience. We work
                        tirelessly to ensure {{ site('name') }} remains a frontrunner in the field.
                    </p>
    
                    
    
    
    
    
    
    
                </div>
    
                <div class="w-full md:hidden">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/4.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
                <div class="">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>
    
                        </div>
    
    
                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Your Trust, Our Commitment</h2>
                    <h1 class="text-6xl rescron-font-bold">Upholding Values of Integrity and Transparency </h1>
                    <p class="text-xl text-gray-500 mt-5">
                        At {{ site('name') }}, integrity and transparency are non-negotiable values. We prioritize your
                        security and
                        satisfaction above all else. We've created a secure and user-friendly trading environment where you can
                        confidently pursue your financial goals.
                    </p>
    
    
    
    
    
    
    
                </div>
    
                <div class="w-full ">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/5.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
                <div class="w-full sm:hidden">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/6.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
    
                <div class="">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>
    
                        </div>
    
    
                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Supporting Your Trading Journey</h2>
                    <h1 class="text-6xl rescron-font-bold">Connecting with {{ site('name') }} </h1>
                    <p class="text-xl text-gray-500 mt-5">
                        We understand that navigating the financial markets can be challenging. That's why our support team is
                        here for you. Whether you have questions, feedback, or require assistance, we're just a message away.
                        Your success is our success, and we are committed to supporting you every step of the way.
                    </p>
                    <p >
                        With {{ site('name') }}, you're not just trading; you're part of a revolutionary movement in the world of
                        finance. Join us today and experience the future of trading - where innovation, technology, and your
                        success converge.
                    </p class="text-xl text-gray-500 mt-5">
                    <div class="flex items-center space-x-3 justify-start pb-10 mt-10">
                        <a class="rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                            href="{{ route('user.login') }}">
                            <span>Sign In</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a class="bg-purple-500 rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                            href="{{ route('user.register') }}">
                            <span>Sign Up</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
    
    
    
    
    
    
                </div>
    
                <div class="w-full md:hidden">
                    <div>
                        <img class="rounded-lg" src="{{ asset('assets/images/about/6.png') }}" alt="">
                        <div class="md:hidden h-16"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

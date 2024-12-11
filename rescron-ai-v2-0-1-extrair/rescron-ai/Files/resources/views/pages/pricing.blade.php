@php
    use App\Models\Bot;
    
    $page_title = 'AI Bot Pricing';
    $short_description = 'We have vering portfolio ranges for our bots. Select any hat best fits your pocket';
    $bots = Bot::get();
    
@endphp

{{-- layout --}}
@extends('layouts.front')





@section('contents')
    {{-- breadcrumb --}}
    @include('pages.breadcrumb')

    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center">
            <div class="w-full flex items-center justify-center">
                <div class="w-full lg:w-3/4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mt-10">
                    @foreach ($bots as $bot)
                        <div
                            class="rounded-lg shadow border border-slate-800 hover:border-slate-600 cursor-pointer p-5 transition-all">
                            <div class="mb-2">
                                <p class="flex space-x-1 text-purple-500 items-center text-xl rescron-font-bold mb-5">
                                    <img class="w-8 h-8 bg-white rounded-full" src="{{ asset('storage/bots/' . $bot->logo) }}"
                                        alt="">
                                    <span>{{ $bot->name }}</span>
                                </p>
    
                                <div class="w-full flex justify-center items-baseline mb-1 mt-1 text-center">
                                    <p class="rounded-full ts-gray-3 text-orange-500 font-2xl rescron-font-bold px-3">
                                        {{ $bot->daily_min }}% - {{ $bot->daily_max }}% <span
                                            class="text-xs text-gray-500">/day</span></p>
                                </div>
    
                            </div>
    
                            <div class="mt-10 text-xs">
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                        <span>Portfolio Range</span>
                                    </p>
                                    <p class="">{{ site('currency_symbol') . $bot->min }} -
                                        {{ site('currency_symbol') . $bot->max }}</p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                        <span>Daily PNL</span>
                                    </p>
                                    <p class="">{{ $bot->daily_min }}% - {{ $bot->daily_max }}%</p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                        <span>Trading Duration</span>
                                    </p>
                                    <p class="">{{ $bot->duration }} {{ $bot->duration_type }}</p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                        <span>Capital Returned</span>
                                    </p>
                                    <p class="">Yes</p>
                                </div>
    
                                <div class="text-bold mt-2 mb-2 text-center">
                                    Trading Days
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Monday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('monday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Tuesday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('tuesday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
    
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Wednesday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('wednesday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
    
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Thursday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('thursday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Friday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('friday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Saturday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('saturday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
    
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500 flex space-x-1 items-center">
    
                                        <span>Sunday</span>
                                    </p>
                                    <p class="">
                                        @if (in_array('sunday', json_decode(site('trading_days'))))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-green-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                    </p>
                                </div>
                            </div>
    
                            <div class="mt-10">
                                <a class="rounded-full shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1 hover:scale-110 transition-all"
                                    href="{{ route('user.bots.index') }}">
                                    <span>Activate</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
    
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

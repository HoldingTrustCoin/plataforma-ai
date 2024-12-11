@php
    use App\Models\DepositCoin;
    use App\Models\Bot;
    use Faker\Factory as Faker;
    

    $page_title = 'Home';
    $faker = Faker::create();
    $logos = DepositCoin::inRandomOrder()
        ->take(20)
        ->get('logo_url');
    
    $bots = Bot::get();
    
    $deposit_methods = ['usdttrc20'];
    $methods = DepositCoin::where('status', 1)->get();
    foreach ($methods as $method) {
        array_push($deposit_methods, $method->code);
    }
    
    // Check if the count is less than 20
    while (count($deposit_methods) < 20) {
        $deposit_methods[] = 'usdttrc20';
    }
    
    $actions = ['deposited', 'withdrew', 'withdrew', 'deposited', 'withdrew', 'deposited', 'withdrew', 'withdrew', 'withdrew', 'withdrew', 'withdrew', 'withdrew'];
    
    $whys = ['Cutting-Edge Precision', 'Trendsetter Advantage', 'Adaptive Excellence', 'Seamless Profits', 'Data-Driven Triumph', 'Strategic Partner', 'Constant Success', 'Market Pioneer', 'Automated Mastery'];
    $reviews = [
        site('name') . "'s precision trading is a game-changer, consistently delivering impressive profits. I trust it for my financial success.",
        'Effortless trading with ' . site('name') . '. Its adaptability and data-driven approach make it a standout choice. Highly recommended!',
        'Seamless trades, constant profits - ' . site('name') . " simplifies trading. It's a must-have for anyone in the market.",
        site('name') . "'s innovative strategies and consistent returns have transformed my trading experience. It's a valuable asset to any trader.",
        'I rely on ' . site('name') . " for its adaptability in fluctuating markets. It's a proven partner in achieving financial goals.",
        site('name') . "'s automated precision is remarkable. It's a powerful tool for navigating today's complex trading landscape.",
        'Maximized profits with ' . site('name') . '. Its results speak volumes. A reliable and intelligent trading companion.',
        'Trading with ' . site('name') . ' is effortless and rewarding. It adapts to market changes seamlessly. Truly impressive!',
        site('name') . ' has changed my trading game. Its data-driven approach delivers consistent gains. An invaluable tool for success.',
        'Effortless trading made possible by ' . site('name') . ' .  Its strategic prowess sets it apart. A game-changer for traders.',
    ];

    $short_description =  site('seo_description');
    
@endphp

@extends('layouts.front')


@section('contents')
    {{-- hero starts here --}}
    <section class="relative w-full overflow-hidden">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 relative">
            <div class="p-5 md:px-20 py-2 mt-10 z-10">

                <div class="mt-10 grid grid-cols-1 gap-3">
                    <div class="sm:hidden mt-10">
                        <i class="bi bi-circle-fill text-purple-500"></i>
                        <i class="bi bi-circle-fill text-orange-500"></i>
                        <i class="bi bi-circle-fill"></i>

                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Data-Driven Gains</h2>
                    <h1 class="text-6xl rescron-font-bold">Effortless Trading, Consistent Gains - AI Brilliance</h1>
                    <p class="text-xl text-gray-500">
                        {{ site('name') }} uses advanced Ai robots trained on extensive trading data and algorithms to
                        analyze market trends and execute profitable trades with high precision. Our AI bots maintain an
                        average 5% daily PNL.
                    </p>

                    <div class="flex items-center space-x-3 justify-start pb-10">
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
            </div>
            <div class="relative  overflow-hidden-x sm:-top-70">
                <div class="circle h-120 w-full relative sm:absolute -right-50 md:p-10">
                    <div class="w-full relative h-full">
                        <img class="w-32 floating-image absolute ts-gray-2 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/1.png') }}">
                        <img class="w-32 floating-image absolute ts-gray-3 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/2.png') }}">
                        <img class="w-32 floating-image absolute ts-gray-3 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/3.png') }}">
                        <img class="w-32 floating-image absolute ts-gray-3 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/4.png') }}">
                        <img class="w-32 floating-image absolute ts-gray-3 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/5.png') }}">
                        <img class="w-32 floating-image absolute ts-gray-3 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/6.png') }}">
                        <img class="w-32 floating-image absolute ts-gray-3 p-3 rounded-full shadow-lg"
                            src="{{ asset('assets/images/ai-randoms-nbg/7.png') }}">


                    </div>



                </div>
            </div>
        </div>
    </section>
    {{-- hero ends here --}}

    {{-- logos --}}
    <section class="w-full px-5 md:px-20 py-5 ts-gray-3">
        <div class="owl-carousel looping-image">
            @foreach ($logos as $logo)
                <div class="item">
                    <div class="w-16 h-16 ">
                        <img class="rounded-full p-3 grayscale hover:grayscale-0 cursor-pointer"
                            src="{{ 'https://nowpayments.io' . $logo->logo_url }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    {{-- unlock market --}}
    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center items-center text-center">
            <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                <div class="sm:hidden mt-10">
                    <i class="bi bi-circle-fill text-green-500"></i>
                    <i class="bi bi-circle-fill text-blue-500"></i>
                    <i class="bi bi-circle-fill text-red-500"></i>

                </div>
                <h1 class="text-6xl rescron-font-bold">Unlocking Markets, Amplifying Returns</h1>
                <p class="text-xl text-gray-500">
                    Your ultimate trading companion, utilizing cutting-edge technology to unlock new market potentials and
                    amplify your investment returns like never before.
                </p>
            </div>


        </div>
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-5 mt-10">
            <div class="ai-bg-1 rounded-lg">
                <div class="h-8"></div>
                <div>
                    <div class="flex justify-end">
                        <img src="{{ asset('assets/images/ai/1.png') }}" alt="">
                    </div>
                    <div class="p-3 semi-transparent">
                        <h3 class="rescron-font-bold"><br>Automated Process</h3>
                        <p>Our advanced technology streamlines processes, allowing you to navigate markets seamlessly and
                            achieve maximum success. <br><br> Navigate uncertainty with {{ site('name') }}</p>
                    </div>
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="ai-bg-2 rounded-lg">

                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/ai/2.png') }}" alt="">
                    </div>
                    <div class="p-3 semi-transparent">
                        <h3 class="rescron-font-bold"><br><br>Guaranteed Profit</h3>
                        <p>Harness the power of our Guaranteed Profit approach and let AI elevate your trading endeavors,
                            ensuring consistent gains. </p>
                    </div>

                </div>
                <div class="ai-bg-3 rounded-lg">

                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/ai/3.png') }}" alt="">
                    </div>
                    <div class="p-3 semi-transparent">
                        <h3 class="rescron-font-bold"><br>Bullish Or Bearish</h3>
                        <p>Leveraging advanced technology to navigate challenging market conditions, ensuring your financial
                            goals remain achievable even in bearish market scenarios.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- trading marque --}}
    <section class="w-full px-5 md:px-20 py-5 ts-gray-3">
        <div id="cr-widget-marquee" data-coins="bitcoin,ethereum,tether,ripple,cardano" data-theme="dark"
            data-show-symbol="true" data-show-icon="true" data-show-period-change="true" data-period-change="24H"
            data-api-url="https://api.cryptorank.io/v0">
            <script src="https://cryptorank.io/widget/marquee.js"></script>
        </div>
    </section>


    {{-- pricing --}}
    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center items-center text-center">
            <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                <h2 class="uppercase text-orange-500 font-mono">Pricing</h2>
                <h1 class="text-6xl rescron-font-bold">AI Trading Portfolios</h1>

            </div>


        </div>
        <div class="flex items-center justify-center">
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

    </section>

    {{-- why choose us --}}
    <section class="w-full px-5 md:px-20 py-10 mt-10">

        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="">
                <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                    <div class="sm:hidden mt-10">
                        <i class="bi bi-circle-fill text-green-500"></i>
                        <i class="bi bi-circle-fill text-blue-500"></i>
                        <i class="bi bi-circle-fill text-red-500"></i>

                    </div>


                </div>
                <h2 class="uppercase text-orange-500 font-mono">Supercharged Ai</h2>
                <h1 class="text-6xl rescron-font-bold">Why Choose {{ site('name') }}?</h1>
                <p class="text-xl text-gray-500 mt-5">
                    {{ site('name') }} doesn't just follow trends - it pioneers them. It empowers traders to navigate both
                    bullish
                    and bearish market conditions with unwavering confidence. By leveraging sophisticated algorithms and
                    real-time data streams, {{ site('name') }} adapts to ever-changing market dynamics, seizing
                    opportunities while
                    minimizing risks.
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
                <div class="sm:hidden ">
                    <div class="h-10"></div>
                    <div class="h-12"></div>
                    <div class="h-5"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3">
                    @foreach ($whys as $key => $why)
                        <div class="flex items-center justify-center">
                            <div class="w-full">
                                <div
                                    class="rounded-lg shadow border border-slate-800 hover:border-slate-600 cursor-pointer px-5 py-1  transition-all text-center">
                                    <div class="w-full flex items-center justify-center">
                                        <img class=" p-3 rounded-full ts-gray-3"
                                            src="{{ asset('assets/images/whys/' . $key + 1 . '.png') }}" alt="">
                                    </div>
                                    <span class="text-xs">
                                        {{ $why }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- trade from anywhere --}}
    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center items-center text-center">
            <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                <div class="sm:hidden mt-10">
                    <i class="bi bi-circle-fill text-green-500"></i>
                    <i class="bi bi-circle-fill text-blue-500"></i>
                    <i class="bi bi-circle-fill text-red-500"></i>

                </div>
                <h1 class="text-6xl rescron-font-bold">Trade From Anywhere</h1>
                <p class="text-xl text-gray-500">
                    Whether you're at home or on the go, seize market opportunities anytime, anywhere, and secure your
                    financial future effortlessly. Trade from any and every city
                </p>
            </div>


        </div>
        <div class="w-full lg:flex mt-10">
            <div class="w-full lg:w-2/3 lg:space-x-5 rounded-lg mb-5">
                <div class="w-full overflow-hidden flex items-center justify-center">
                    <div id="globeViz" class="w-full relative flex justify-center items-center"></div>

                </div>
            </div>
            <div class="w-full">
                <div class="w-full">
                    <div class="w-full p-3">
                        <h3 class="rescron-font-bold">Recent Trades by {{ site('name') }}</h3>
                        <div class="w-full h-110 overflow-hidden" id="recentTradesContainer">
                            <div class="w-full grid grid-cols-1 gap-3 mt-2 text-xs" id="recentTrades">
                                @foreach (recentTrades() as $data)
                                    <div
                                        class="recent-trade w-full ts-gray-3 rounded-lg p-2 flex justify-between @if ($data['type'] == 1) text-green-500 @else text-red-500 @endif">
                                        <p class="recent_trade_time"></p>
                                        <p>{{ $data['pair'] }}</p>
                                        <p>{{ $data['amount'] }}</p>
                                        <p>{{ $data['profit'] }}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- reviews --}}
    <section class="w-full px-5 md:px-20 py-5">
        <p class="text-orange-500 rescron-font-italics text-xl text-center sm:hidden">Our Users say;</p>
        <div class="flex justify-center items-center dot-rec sm:hidden">
            <div class="w-full md:w-3/4">
                <div class="h-36"></div>
                <div class="h-10"></div>
                <div class="w-full overflow-hidden flex items-center  p-3">
                    <div class="w-full text-center">

                        <div class="owl-carousel reviews">
                            @foreach ($reviews as $review)
                                <div class="item text-center">

                                    <p class="text-6xl rescron-font-bold-italics">{{ '"' . $review . '"' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="h-36"></div>
                <div class="h-10"></div>
            </div>
        </div>
        <div class="text-orange-500 md:hidden">
            <p class="text-orange-500 rescron-font-italics text-xl">Our Users say;</p>
        </div>
        <div class="flex justify-center items-center dot-rec p-2 overflow-hidden md:hidden">
            <div class="w-full md:w-3/4">

                <div class="w-full overflow-hidden flex items-center  p-3">
                    <div class="owl-carousel reviews">
                        @foreach ($reviews as $review)
                            <div class="item text-center">
                                <p class="text-2xl rescron-font-bold-italics">{{ '"' . $review . '"' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="w-full px-5 md:px-20 py-5">

        <div class="w-full grid grid-cols-1 relative">
            <div class="w-full">

                <div class="mt-10 w-full">
                    <div class="w-full grid grid-cols-1 gap-1 text-center">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-purple-500"></i>
                            <i class="bi bi-circle-fill text-orange-500"></i>
                            <i class="bi bi-circle-fill"></i>

                        </div>
                        <h2 class="uppercase text-orange-500 font-mono">Getting started</h2>
                        <h1 class="text-6xl rescron-font-bold">How It Works</h1>
                        <div class="w-full p-3 flex justify-center">
                            <p class="text-xl text-gray-500 w-full md:w-3/4">
                                Our user-friendly interface and intuitive features ensure
                                that even newcomers can quickly grasp the essentials and embark on a seamless journey into
                                the world
                                of efficient and profitable trading.
                            </p>
                        </div>

                    </div>

                    <div class="w-full md:flex justify-start">
                        <div class="flex justify-center items-center w-full md:w-110">
                            <div class="h-60 md:h-110 w-60  md:w-110 flex justify-center items-center" id="hows-bot">
                                <div class="w-60 md:w-110 h-60 md:h-110 hows-bg animate-circle">

                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="w-full">
                                <div class="h-12"></div>
                                <div class="w-full md:w-3/4">
                                    <div class="w-full grid grid-cols-1 gap-3">
                                        <div class="w-full flex justify-start items-center space-x-2">
                                            <div
                                                class="w-full flex justify-start rounded-lg overflow-hidden overflow-hidden shadow border border-slate-800 hover:border-slate-600 cursor-pointer transition-all">
                                                <div class="flex items-center justify-center p-3 h-24 ">
                                                    <img class="w-16 bg-orange-500  rounded-full p-1"
                                                        src="{{ asset('assets/images/hows/1.png') }}" alt="">
                                                </div>
                                                <div class="p-3 h-24 overflow-hidden w-full ts-gray-3">
                                                    <h3 class=" rescron-bold-font">Step 1: Sign Up</h3>
                                                    <p class="text-gray-500">Signing up is a breeze - just a few clicks,
                                                        and you're in.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-full flex justify-start items-center space-x-2">
                                            <div
                                                class="w-full flex justify-start rounded-lg overflow-hidden overflow-hidden shadow border border-slate-800 hover:border-slate-600 cursor-pointer transition-all">
                                                <div class="flex items-center justify-center p-3 h-24 ">
                                                    <img class="w-16 bg-green-500  rounded-full p-1"
                                                        src="{{ asset('assets/images/hows/2.png') }}" alt="">
                                                </div>
                                                <div class="ts-gray-3 p-3 h-24 overflow-hidden w-full">
                                                    <h3 class="rescron-bold-font">Step 2: Deposit Funds</h3>
                                                    <p class="text-gray-500">Add money to your {{ site('name') }}
                                                        following our user friendly funding system</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-full flex justify-start items-center space-x-2">
                                            <div
                                                class="w-full flex justify-start rounded-lg overflow-hidden overflow-hidden shadow border border-slate-800 hover:border-slate-600 cursor-pointer transition-all">
                                                <div class=" flex items-center justify-center p-3 h-24 ">
                                                    <img class="w-16 bg-blue-500  rounded-full p-1"
                                                        src="{{ asset('assets/images/hows/3.png') }}" alt="">
                                                </div>
                                                <div class="p-3 ts-gray-3 h-24 overflow-hidden w-full">
                                                    <h3 class="rescron-bold-font">Step 3: Activate Bot</h3>
                                                    <p class="text-gray-500">Select from our wide range of AI trading bots
                                                        and activate a portfolio.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-full flex justify-start items-center space-x-2">
                                            <div
                                                class="w-full flex justify-start rounded-lg overflow-hidden overflow-hidden shadow border border-slate-800 hover:border-slate-600 cursor-pointer transition-all">
                                                <div class="flex items-center justify-center p-3 h-24 ">
                                                    <img class="w-16 bg-purple-500  rounded-full p-1"
                                                        src="{{ asset('assets/images/hows/4.png') }}" alt="">
                                                </div>
                                                <div class="ts-gray-3 p-3 h-24 overflow-hidden w-full">
                                                    <h3 class="rescron-bold-font">Step 4: Withdraw</h3>
                                                    <p class="text-gray-500"> Withdraw your capital and profits to your
                                                        external wallet at anytime.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>



        </div>
    </section>

    {{-- deposits --}}
    <section class="w-full px-5 md:px-20 py-5 ts-gray-3 mt-10" id="deposits">
        <div class="owl-carousel deposits">
            @foreach ($deposit_methods as $method)
                <div class="item">
                    <div class="flex space-x-1 justify-center items-center">
                        <p>
                            {{ $faker->firstName }} just {{ $actions[rand(0, 11)] }}
                            {{ site('currency') . number_format(rand(500, 8000) + 1 / rand(3, 8), 2) }} via
                        </p>
                        <div class="w-5 h-5">
                            <img class="rounded-full ts-gray-1 cursor-pointer"
                                src="{{ 'https://nowpayments.io/images/coins/' . strtolower($method) . '.svg' }}"
                                alt="">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- market depth --}}
    <section class="w-full px-5 md:px-20 py-5 mt-10">
        <div class="w-full  flex justify-center items-center text-center">
            <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                <h2 class="uppercase text-orange-500 font-mono">Market Data</h2>
                <h1 class="text-6xl rescron-font-bold">Market HeatMap</h1>

            </div>


        </div>

        <div class="h-24"></div>
        <qc-heatmap height="400px" num-of-coins="50" currency-code="USD"></qc-heatmap>
        <script src="https://quantifycrypto.com/widgets/heatmaps/js/qc-heatmap-widget.js"></script>

    </section>


    {{-- ai --}}
    <section class="w-full px-5 md:px-20 py-5 mt-10">
        <div class="w-full flex justify-between items-center h-24 md:hidden">
            <img class="w-16 h-16  animate-circle " src="{{ asset('assets/images/donuts/1.png') }}" alt="">
            <img class="w-16 h-16  animate-circle" src="{{ asset('assets/images/donuts/2.png') }}" alt="">
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 ts-gray-2 rounded-lg p-5">
            <div class="w-full relative sm:hidden">
                <div class="relative flex justify-start">

                    <div class="w-full">
                        <div class="w-full flex justify-between items-center">
                            <img class="w-16 h-16 animated-image  animate-circle " src="{{ asset('assets/images/donuts/1.png') }}" alt="">
                            <img class="w-16 h-16  animate-circle" src="{{ asset('assets/images/donuts/2.png') }}" alt="">
                        </div>
                        <div class="h-72 sm:hidden">

                        </div>

                        <h3 class="shown-typing text-2xl rescron-font-bold typing-animation">
                            Unlocking Wealth with Simplicity

                        </h3>


                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-purple-500"></i>
                            <i class="bi bi-circle-fill text-orange-500"></i>
                            <i class="bi bi-circle-fill"></i>

                        </div>
                    </div>
                </div>
            </div>
            

            <div class="relative w-full ts-gray-3 p-1 rounded-lg overflow-hidden">
                <div class="w-full md:h-96">
                    <div class="w-full flex justify-end">
                        <div class="">
                            <i class="bi bi-circle-fill text-purple-500"></i>
                            <i class="bi bi-circle-fill text-orange-500"></i>
                            <i class="bi bi-circle-fill"></i>

                        </div>
                    </div>

                    <img class="w-full" src="{{ asset('assets/images/laptop-mockup.png') }}" alt="">

                </div>


            </div>
        </div>
    </section>
@endsection








@section('scripts')
    {{-- spining image --}}

    <script>
        const circle = document.querySelector('.circle');
        const images = document.querySelectorAll('.floating-image');
        const numImages = images.length;
        const deviceWidth = window.innerWidth;

        let radius;
        if (deviceWidth > 766) {
            radius = Math.min(circle.clientWidth / 2, circle.clientHeight / 2) - 25;
        } else {
            radius = deviceWidth; // Use a specific value for small deviceWidth
        }

        function moveImageInCircleAndSpin(img, centerX, centerY, angle) {
            const x = centerX + radius * Math.cos(angle);
            const y = centerY + radius * Math.sin(angle);
            const rotation = angle * (180 / Math.PI);

            img.style.left = `${x}px`;
            img.style.top = `${y}px`;
            img.style.transform = `translate(-50%, -50%) rotate(${rotation}deg)`;

            const newAngle = angle + 0.01; // Adjust the rotation speed here
            const randomDelay = Math.random() * 10; // Small delay to adjust rotation phase
            setTimeout(() => {
                moveImageInCircleAndSpin(img, centerX, centerY, newAngle);
            }, randomDelay);
        }

        function initializeImagePositions() {
            const centerX = circle.clientWidth / 2;
            const centerY = circle.clientHeight / 2;

            images.forEach((img, index) => {
                const angle = (index / numImages) * 2 * Math.PI;
                moveImageInCircleAndSpin(img, centerX, centerY, angle);
            });
        }

        initializeImagePositions();
    </script>


    {{-- moving image --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.looping-image').owlCarousel({
                loop: true,
                margin: 5,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplaySpeed: 600,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 5,
                    },
                    600: {
                        items: 10,
                    },
                    1000: {
                        items: 10,
                    }
                }
            });

            $('.reviews').owlCarousel({
                loop: true,
                margin: 5,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplaySpeed: 600,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 1,
                    }
                }
            });

            $('.deposits').owlCarousel({
                loop: true,
                margin: 5,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplaySpeed: 600,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 3,
                    }
                }
            });
        });
    </script>


    {{-- globe --}}
    <script src="//unpkg.com/globe.gl"></script>
    <script>
        fetch("{{ route('places') }}").then(res => res.json()).then(places => {

            const globeInstance = Globe()
                .globeImageUrl("{{ asset('assets/images/earth-night.jpg') }}")
                .backgroundImageUrl("{{ asset('assets/images/ts-gray-1.png') }}")
                .labelsData(places.features)
                .labelLat(d => d.properties.latitude)
                .labelLng(d => d.properties.longitude)
                .labelText(d => d.properties.name)
                .labelSize(d => Math.sqrt(d.properties.pop_max) * 4e-4)
                .labelDotRadius(d => Math.sqrt(d.properties.pop_max) * 4e-4)
                .labelColor(() => 'rgba(255, 165, 0, 0.75)')
                .labelResolution(2)

            (document.getElementById('globeViz'))


        });
    </script>

    {{-- schuffle recent trades --}}
    <script>
        function updateTradeTimes() {
            const tradeTimeElements = document.querySelectorAll('.recent_trade_time');
            const currentTime = new Date().toLocaleTimeString();

            tradeTimeElements.forEach((element) => {
                element.textContent = currentTime;
            });
        }

        function shuffleAndDisplayRecentTrades() {
            const tradesDiv = document.getElementById('recentTrades');
            const trades = Array.from(tradesDiv.children);

            trades.sort(() => Math.random() - 0.5); // Shuffle the array

            // Remove the existing trade divs
            while (tradesDiv.firstChild) {
                tradesDiv.removeChild(tradesDiv.firstChild);
            }

            // Append the first 10 shuffled trade divs back to the container
            for (let i = 0; i < 20 && i < trades.length; i++) {
                tradesDiv.appendChild(trades[i]);
            }

            updateTradeTimes(); // Update trade times after shuffling
        }

        // Initial shuffle and display
        shuffleAndDisplayRecentTrades();

        // Set interval to shuffle and update times every second (1000 milliseconds)
        setInterval(shuffleAndDisplayRecentTrades, 1000);

        // update every 5 minutes
        function updateRecentTrades() {
            // Use jQuery to make an AJAX request to the server
            $.ajax({
                url: window.location.href,
                method: 'GET',
                dataType: 'html',
                success: function(response) {
                    // Update the content of the recentTradesContainer div
                    var targetDiv = '#recentTradesContainer';
                    $(targetDiv).html($(response).find(targetDiv).html());
                    updateTradeTimes();
                    $('#deposits').html($(response).find('#deposits').html());

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        setInterval(updateRecentTrades, 10000);
    </script>

    {{-- apply bot class --}}
    <script>
        const divElement = document.getElementById('hows-bot');
        const classes = ['hows-bot-orange', 'hows-bot-green', 'hows-bot-blue', 'hows-bot-purple'];
        let currentIndex = 0;

        function applyNextClass() {
            divElement.className = classes[currentIndex];
            currentIndex = (currentIndex + 1) % classes.length;
        }

        setInterval(applyNextClass, 5000);
    </script>
@endsection

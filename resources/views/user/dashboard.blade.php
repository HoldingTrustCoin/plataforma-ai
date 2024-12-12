@extends('layouts.user')

@section('contents')
    <div class="w-full w-full p-3 mb-2 grid grid-cols-1  md:grid-cols-2 lg:grid-cols-3 gap-5 lg:place-content-evenly">
        <div
            class="w-full flex items-center h-28 ts-gray-2 rounded-lg p-2 border border-slate-800 hover:border-slate-600 transition-all">
            <div class="w-full">
                <div class="w-full flex items-center justify-between mb-2">
                    <div>
                        <p class=" font-bold text-gray-500">Account</p>
                    </div>
                    <div class="flex items-center space-x-1">


                        <div class="flex text-green-500 ts-gray-3 px-2 py-1 rounded-full hover:scale-110 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                    clip-rule="evenodd" />
                            </svg>
                            @if ($percentage_deposit_increase > 0)
                                <span>+ {{ round($percentage_deposit_increase, 2) }}%</span>
                            @else
                                <span>+0%</span>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="w-full flex items-center justify-between">
                    <div class="flex items-center space-x-2 font-mono">
                        <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
                                <path fill-rule="evenodd"
                                    d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z" />
                            </svg>
                        </div>

                        {{ formatAmount(user()->balance) }}
                    </div>
                    <div class="text-xs font-mono text-gray-500">
                        +{{ formatAmount($todays_deposits) }} today
                    </div>

                </div>
            </div>

        </div>

        <div
            class="w-full flex items-center h-28 ts-gray-2 rounded-lg p-2 border border-slate-800 hover:border-slate-600 transition-all">
            <div class="w-full">
                <div class="w-full flex items-center justify-between mb-2">
                    <div>
                        <p class=" font-bold text-gray-500">All Time PNL</p>
                    </div>
                    <div class="flex items-center space-x-1">

                        <div class="flex text-green-500 ts-gray-3 px-2 py-1 rounded-full hover:scale-110 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span>{{ number_format($profit_percent, 2) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="w-full flex items-center justify-between">
                    <div class="flex items-center space-x-2 font-mono">
                        <div class="ts-gray-3 text-green-500 rounded-full p-2 w-8 h-8">
                            <svg xmlns="http://www.w3.org/2000/svg"class="w-4 h-4" fill="currentColor" class="bi bi-coin"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                            </svg>
                        </div>

                        {{ formatAmount($profit_fig + $capital) }}
                    </div>
                    <div class="text-xs font-mono text-gray-500">
                    </div>

                </div>
            </div>

        </div>

        <div
            class="w-full flex items-center h-28 ts-gray-2 rounded-lg p-2 border border-slate-800 hover:border-slate-600 transition-all">
            <div class="w-full">
                <div class="w-full flex items-center justify-between mb-2">
                    <div>
                        <p class=" font-bold text-gray-500">AI Bots</p>
                    </div>
                    <div class="flex items-center space-x-1">


                    </div>
                </div>

                <div class="w-full flex items-center justify-between">
                    <div class="flex items-center space-x-2 font-mono">
                        <div class="ts-gray-3 text-orange-500 rounded-full p-2 w-8 h-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" class="bi bi-robot"
                                viewBox="0 0 16 16">
                                <path
                                    d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135Z" />
                                <path
                                    d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2V1.866ZM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5Z" />
                            </svg>
                        </div>

                        {{ user()->botActivations()->count() }}
                    </div>
                    <div class="text-xs font-mono text-gray-500">
                        +{{ user()->botHistory()->count() }} trades
                    </div>

                </div>
            </div>

        </div>











    </div>

    <div class="w-full p-3">
        <div class="w-full mb-2">




            <div class="w-full mb-2 lg:flex justify-between lg:space-x-3 lg:gap-3">
                <div class="w-full  ts-gray-2 rounded-lg p-3 mb-5">
                    <div class="w-full flex justify-between items-center">
                        <h2 class="text-sm font-bold">
                            My Bots
                        </h2>
                        <a class="border-b-2 text-xs hover:scale-110 transition-all"
                            href="{{ route('user.bots.index') }}">View All</a>

                    </div>

                    <div class="grid grid-cols-1 gap-3 mt-5">

                        @forelse ($activations as $bot)
                            <div
                                class="w-full ts-gray-3 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <div class="rounded-lg">

                                    <div class="p-2">
                                        <div class="w-full flex justify-between items-center mb-2">
                                            <p class="flex space-x-1 items-center"><img
                                                    class="w-8 h-8 bg-white rounded-full"
                                                    src="{{ asset('storage/bots/' . $bot->bot->logo) }}" alt="">
                                                <span class="font-mono font-semibold text-left">{{ $bot->bot->name }}</span>

                                            </p>
                                            <p>
                                                @if ($bot->status == 'active')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                        fill="currentColor" class="bi bi-patch-check-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                                        fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg>
                                                @endif
                                            </p>

                                        </div>
                                        <div class="w-full">
                                            <div class="grid grid-cols-2 gap-2">


                                                <p class="text-xs text-mono grid grid-cols-1"><span
                                                        class="text-orange-500 text-xs">Portfolio Balance</span>
                                                    <span>{{ formatAmount($bot->balance) }}</span>
                                                </p>

                                                <p class="text-xs text-mono grid grid-cols-1"><span
                                                        class="text-orange-500 text-xs text-right">PNL</span>
                                                    @if ($bot->profit < 0)
                                                        <span class="text-red-500 flex space-x-1 flex justify-end">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="currentColor" class="w-6 h-6">
                                                                <path fill-rule="evenodd"
                                                                    d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span>{{ round(($bot->profit / ($bot->capital + 0.0001)) * 100, 2) }}%</span>
                                                        </span>
                                                    @else
                                                        <span class="text-green-500 flex space-x-1 flex justify-end">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="currentColor" class="w-6 h-6">
                                                                <path fill-rule="evenodd"
                                                                    d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span>+{{ round(($bot->profit / ($bot->capital + 0.0001)) * 100, 2) }}%</span>
                                                        </span>
                                                    @endif
                                                </p>


                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        @empty
                            <div
                                class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span>You have not activated any bot</span>
                            </div>
                        @endforelse






                    </div>
                </div>

                <div class="w-full  ts-gray-2 rounded-lg p-3 mb-5">
                    <div class="w-full flex justify-between items-center">
                        <h2 class="text-sm font-bold text-gray-500">
                            Recent Trades
                        </h2>

                        <a class="border-b-2 text-xs hover:scale-110 transition-all"
                            href="{{ route('user.bots.index') }}">View All</a>

                    </div>



                    <div class="grid grid-cols-1 gap-3 mt-5">

                        @forelse ($histories as $history)
                            <div
                                class="w-full ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <div class="flex px-2 justify-between items-center">
                                    <p class="flex space-x-1 p-3"><img class="w-5 h-5 bg-white rounded-full"
                                            src="{{ asset('storage/bots/' . $history->botActivation->bot->logo) }}"
                                            alt="">
                                        <span>{{ $history->botActivation->bot->name }}</span>

                                    </p>

                                    <p class="text-purple-500 font-mono">{{ $history->pair }}</p>

                                </div>
                                <div class="w-full flex justify-between items-center p-2 text-xs">
                                    <p><span class="local-time">{{ date('d-m-y H:i:s', $history->timestamp) }}</span>
                                        @if ($history->profit < 0)
                                            <p class="flex justify-end items-center text-red-500">
                                                -{{ formatAmount(str_replace('-', '', $history->profit)) }}
                                            </p>
                                            <p class="flex justify-end items-center text-red-500">
                                                {{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                            </p>
                                        @else
                                            <p class="flex justify-end items-center text-green-500">
                                                +{{ formatAmount($history->profit) }}</p>
                                            <p class="flex justify-end items-center text-green-500">
                                                +{{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                            </p>
                                        @endif



                                </div>


                            </div>

                        @empty
                            <div
                                class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span>Empty Record. No trading history found!</span>
                            </div>
                        @endforelse






                    </div>


                </div>
            </div>

            <div class="w-full ts-gray-2 rounded-lg p-3 mb-5">
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-sm font-bold">
                        AI Trading Overview (7 Day PNL)
                    </h2>

                </div>


                <div class="mt-3 w-full">
                    <div class="w-full ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600">
                        <div id="profitChart" class="ct-chart mt-3"></div>
                    </div>

                </div>




            </div>

        </div>
    </div>

    <div class="w-full p-3">
        <div class="w-full mb-2 lg:flex justify-between lg:space-x-3 lg:gap-3">


            <div class="w-full ts-gray-2 rounded-lg p-3 mb-5">
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-sm font-bold">
                        Recent Deposits
                    </h2>
                    <a class="border-b-2 text-xs hover:scale-110 transition-all"
                        href="{{ route('user.deposits.index') }}">View All</a>
                </div>


                <div class="mt-4 w-full">
                    @forelse ($deposits as $deposit)
                        <div
                            class="w-full flex justify-between items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer mb-2 text-xs">
                            <div class="">
                                <p class="local-time">{{ date('d-m-y H:i:s', strtotime($deposit->created_at)) }}</p>
                                <p class="font-bold text-mono">{{ formatAmount($deposit->amount) }}</p>
                                <p class="flex space-x-1"><img class="w-5 h-5"
                                        src="{{ 'https://nowpayments.io' . $deposit->depositCoin->logo_url }}"
                                        alt="">
                                    <span>{{ $deposit->depositCoin->name }}</span>
                                </p>
                            </div>
                            <div class="">
                                <p class="flex justify-end items-center space-x-1">
                                    @if ($deposit->status == 'waiting')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-500"
                                            fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span class="text-gray-500 uppercase text-xs">{{ $deposit->status }}</span>
                                    @elseif ($deposit->status == 'finished')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-500"
                                            fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                        </svg>
                                        <span class="text-green-500 uppercase text-xs">{{ $deposit->status }}</span>
                                    @elseif ($deposit->status == 'expired' || $deposit->status == 'failed' || $deposit->status == 'refunded')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-red-500"
                                            fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span class="text-red-500 uppercase text-xs">{{ $deposit->status }}</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-orange-500"
                                            fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span class="text-orange-500 uppercase text-xs">{{ $deposit->status }}</span>
                                    @endif
                                </p>
                                <p class="flex justify-end">
                                    {{ $deposit->converted_amount . ' ' . $deposit->currency }}</p>

                            </div>
                        </div>

                    @empty
                        <div
                            class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="currentColor"
                                class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <span>Empty Record. No depsoit found!</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="w-full ts-gray-2 rounded-lg p-3 mb-5">
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-sm font-bold">
                        Recent Withdrawals
                    </h2>
                    <a class="border-b-2 text-xs hover:scale-110 transition-all"
                        href="{{ route('user.withdrawals.index') }}">View All</a>
                </div>


                <div class="mt-4 w-full">
                    @forelse ($withdrawals as $withdrawal)
                        <div
                            class="w-full flex justify-between items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer mb-2 text-xs">
                            <div class="">
                                <p class="local-time">{{ date('d-m-y H:i:s', strtotime($withdrawal->created_at)) }}</p>
                                <p class="font-bold text-mono">{{ formatAmount($withdrawal->amount - $withdrawal->fee) }}
                                </p>
                                <p class="flex space-x-1"><img class="w-5 h-5"
                                        src="{{ 'https://nowpayments.io' . $withdrawal->depositCoin->logo_url }}"
                                        alt="">
                                    <span>{{ $withdrawal->depositCoin->name }}</span>
                                </p>
                            </div>
                            <div class="break-all">
                                <p class="flex justify-end items-center space-x-1">
                                    @if ($withdrawal->status == 'pending')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-500"
                                            fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span class="text-gray-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                    @elseif ($withdrawal->status == 'approved')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-500"
                                            fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                        </svg>
                                        <span class="text-green-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                    @elseif ($withdrawal->status == 'rejected' || $withdrawal->status == 'failed' || $withdrawal->status == 'refunded')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-red-500"
                                            fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span class="text-red-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-orange-500"
                                            fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span class="text-orange-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                    @endif
                                </p>
                                <p class="flex justify-end flex items-center space-x-1">
                                    <span>{{ $withdrawal->converted_amount . ' ' . $withdrawal->depositCoin->code }}</span>
                                    <span class="text-xs text-orange-500">
                                        /{{ $withdrawal->depositCoin->network ?? $withdrawal->depositCoin->code }}</span>
                                </p>
                                <p class="flex justify-end clipboard cursor-pointer text-xs break-all"
                                    data-copy="{{ $withdrawal->wallet_address }}">

                                    {{ $withdrawal->wallet_address }}
                                </p>
                            </div>
                        </div>

                    @empty
                        <div
                            class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="currentColor"
                                class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <span>Empty Record. No withdrawal found!</span>
                        </div>
                    @endforelse
                </div>
            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        var profits = {!! json_encode($profits) !!};
        var profitInt = profits.map(value => parseFloat((value * 1).toFixed(2)));

        // var profitPercentages = {!! json_encode($profit_percentages) !!};
        // var profitPercentagesInt = profitPercentages.map(value => parseFloat((value * 1).toFixed(2)));





        Highcharts.chart('profitChart', {
            chart: {
                type: 'area',
                backgroundColor: '#1f1a23', // Set background color here

                plotBackgroundColor: '#1f1a23',
                plotBorderWidth: 1,
                plotBorderColor: 'rgb(168, 85, 247)',

                borderWidth: 0,
                borderColor: 'rgb(168, 85, 247)',
                borderRadius: 10,
                style: {
                    fontFamily: 'Arial, sans-serif',
                    fontSize: '14px',
                    color: '#fff'
                }
            },
            accessibility: {
                point: {
                    descriptionFormatter: function(p) {
                        return p.series.name + ', ' + p.category + ', ' + p.y + '{{ site('currency') }}.';
                    }
                }
            },
            title: {
                text: '<span style="color: white">7 Days PNL</span>'
            },
            subtitle: {
                text: 'Cummulative PNL Chart history for the last 7 days'
            },
            xAxis: {
                categories: {!! json_encode($days) !!},
                crosshair: true
            },
            yAxis: {

                title: {
                    text: '<span style="color: white">PNL ({{ site('currency') }})</span>'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<span style="font-size: 10px">' + this.x +
                        ' PNL</span><br/> {{ site('currency') }} ' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'PNL',
                data: profitInt
            }]
        });
    </script>
@endsection

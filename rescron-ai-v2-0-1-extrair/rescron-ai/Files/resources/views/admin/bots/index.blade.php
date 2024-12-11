@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">


        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-72 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">




                    <a data-target="bot-list" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        All Ai Bots</a>

                    <a data-target="activations" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Bot Activations </a>

                    <a data-target="bot-history" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Ai Trading History</a>







                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="activations">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">AI Bot Activations</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">

                            @forelse ($activations as $bot)
                                <div
                                    class="w-full rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <div class="rounded-lg">
                                        <div class="relative">
                                            <div
                                                class="absolute flex justify-center items-center -top-1 -right-1 border border-slate-800  rounded-lg p-1 text-xs text-white hover:scale-110 transition-all hover:text-white @if ($bot->expires_in < time()) bg-red-500 @else bg-green-500 @endif">
                                                <a role="button" class="flex space-x-1 items-center cursor-pointer"
                                                    id="{{ 'bot_timer_' . $bot->id }}">

                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <div class="w-full flex justify-start space-x-2 items-center mb-2">
                                                <p class="flex space-x-1 items-center"><img
                                                        class="w-8 h-8 bg-white rounded-full"
                                                        src="{{ asset('storage/bots/' . $bot->bot->logo) }}" alt="">
                                                    <span
                                                        class="font-mono font-semibold text-left">{{ $bot->bot->name }}</span>
                                                    @if ($bot->status == 'active')
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5 text-green-500" fill="currentColor"
                                                            class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5 text-gray-500" fill="currentColor"
                                                            class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                    @endif
                                                </p>
                                                <p>
                                                    <a role="button"
                                                        data-url="{{ route('admin.bots.activations.manage', ['id' => $bot->id]) }}"
                                                        class="edit-bot-activation cursor-pointer flex items-center bg-purple-500 px-2 py rounded-lg hover:scale-110 transition-all ">Edit</a>
                                                </p>

                                            </div>
                                            <div class="w-full">
                                                <div class="grid grid-cols-2 lg:grid-cols-3 gap-2">

                                                    <p class="text-xs text-mono grid grid-cols-1"><span
                                                            class="text-orange-500 text-xs">Username</span>
                                                        <span>{{ $bot->user->username }}</span>
                                                    </p>

                                                    <p class="text-xs text-mono grid grid-cols-1"><span
                                                            class="text-orange-500 text-xs">Daily Return</span>
                                                        <span>{{ $bot->bot->daily_min . '%-' . $bot->bot->daily_max . '%' }}</span>
                                                    </p>

                                                    <p class="text-xs text-mono grid grid-cols-1"><span
                                                            class="text-orange-500 text-xs">Activation Date</span>
                                                        <span
                                                            class="local-time">{{ date('d-m-y H:i:s', strtotime($bot->created_at)) }}</span>
                                                    </p>

                                                    <p class="text-xs text-mono grid grid-cols-1"><span
                                                            class="text-orange-500 text-xs">Portfolio</span>
                                                        <span>{{ formatAmount($bot->capital) }}</span>
                                                    </p>

                                                    <p class="text-xs text-mono grid grid-cols-1"><span
                                                            class="text-orange-500 text-xs">Portfolio Balance</span>
                                                        <span>{{ formatAmount($bot->balance) }}</span>
                                                    </p>

                                                    <p class="text-xs text-mono grid grid-cols-1"><span
                                                            class="text-orange-500 text-xs">PNL</span>
                                                        @if ($bot->profit < 0)
                                                            <span
                                                                class="text-red-500 flex space-x-1"><span>{{ ($bot->profit / $bot->capital) * 100 }}%</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                    fill="currentColor" class="w-6 h-6">
                                                                    <path fill-rule="evenodd"
                                                                        d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        @else
                                                            <span
                                                                class="text-green-500 flex space-x-1"><span>+{{ ($bot->profit / $bot->capital) * 100 }}%</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                    fill="currentColor" class="w-6 h-6">
                                                                    <path fill-rule="evenodd"
                                                                        d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
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

                        <div class="w-full mt-5 flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                            data-paginator="activations">
                            {{ $activations->links('paginations.simple') }}
                        </div>

                    </div>

                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card transition-all" id="bot-list">
                    <h3 class="capitalize  font-extrabold flex justify-between items-center"><span class="border-b-2">AI
                            Bots</span>

                        <a role="button" data-target="add-new-bot"
                            class="rescron-card-trigger flex items-center space-x-1 border border-slate-800  rounded-lg p-1 text-xs text-gray-300 font-semibold hover:scale-110 transition-all hover:text-white ts-gray-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            <span>Add Bot</span>
                        </a>

                    </h3>


                    {{-- summary --}}
                    <div class="w-full mt-5 grid grid-cols-2 lg:grid-cols-3 gap-2">
                        <div
                            class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                            <div class="w-full flex items-center justify-between">
                                <div>
                                    <div class="mb-1">
                                        <p class=" font-bold text-gray-500">Total Bots</p>
                                    </div>

                                    <div class="flex items-center justify-start font-mono">


                                        <span>{{ $bots->count() }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div
                            class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                            <div class="w-full flex items-center justify-between">
                                <div>
                                    <div class="mb-1">
                                        <p class=" font-bold text-gray-500">Total Activations</p>
                                    </div>

                                    <div class="flex items-center justify-start font-mono">


                                        <span>{{ $activations->count() }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div
                            class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                            <div class="w-full flex items-center justify-between">
                                <div>
                                    <div class="mb-1">
                                        <p class=" font-bold text-gray-500">Total Trades</p>
                                    </div>

                                    <div class="flex items-center justify-start font-mono">


                                        <span>{{ $histories->count() }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div
                            class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                            <div class="w-full flex items-center justify-between">
                                <div>
                                    <div class="mb-1">
                                        <p class=" font-bold text-gray-500">Portfolio</p>
                                    </div>

                                    <div class="flex items-center justify-start font-mono">


                                        <span>{{ formatAmount($activations->sum('capital')) }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div
                            class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                            <div class="w-full flex items-center justify-between">
                                <div>
                                    <div class="mb-1">
                                        <p class=" font-bold text-gray-500">Portfolio Balance</p>
                                    </div>

                                    <div class="flex items-center justify-start font-mono">


                                        <span>{{ formatAmount($activations->sum('balance')) }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="w-full mb-5 ts-gray-2 rounded-lg transition-all">

                        <div class="">

                            <div class="w-full grid grid-cols-1 lg:grid-cols-2  gap-3 mb-5 px-3 py-10">
                                <style>
                                    .bg-bot-1 {
                                        background-image: url("{{ asset('assets/images/bot-bg-8.jpeg') }}");
                                        background-size: cover;
                                    }
                                </style>
                                @forelse ($bots as $bot)
                                    <div
                                        class="bg-bot-1 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <div style="background: rgb(0, 0, 0, 0.5)" class="rounded-lg">
                                            <div class="relative">
                                                <div data-target="{{ 'edit_bot_' . $bot->id }}"
                                                    class="rescron-card-trigger absolute flex justify-center items-center -top-1 -right-1 border border-slate-800  rounded-lg p-1 text-xs text-gray-300 font-semibold hover:scale-110 transition-all hover:text-white ts-gray-3">
                                                    <a role="button" class=" flex space-x-1 items-center cursor-pointer">
                                                        <img class="w-8 h-8 rounded-full bg-white"
                                                            src="{{ asset('storage/bots/' . $bot->logo) }}"
                                                            alt="">
                                                        <span>Edit</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="p-5">


                                                <div class="px-2 flex items-center justify-between">

                                                    <div class="grid grid-cols-1 gap-3">
                                                        <div class="font-mono font-semibold text-left">
                                                            {{ $bot->name }}
                                                        </div>

                                                        <div class="text-left">
                                                            <h2 class="uppercase text-xs  text-orange-500">Trading
                                                                Portfolio
                                                            </h2>
                                                            <h2>{{ formatAmount($bot->min) . ' - ' . formatAmount($bot->max) }}
                                                            </h2>
                                                        </div>
                                                        <div class="text-left">
                                                            <h2 class="uppercase text-xs  text-orange-500">Avg. Daily PNL
                                                            </h2>
                                                            <h2>{{ $bot->daily_min . '% - ' . $bot->daily_max . '%' }}</h2>
                                                        </div>

                                                        <div class="text-left">
                                                            <h2 class="uppercase text-xs  text-orange-500">Trading Period
                                                            </h2>
                                                            <h2>{{ $bot->duration . $bot->duration_type }}</h2>
                                                        </div>


                                                    </div>


                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                @empty
                                    <div
                                        class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                            fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span>Bots coming soon ...</span>
                                    </div>
                                @endforelse




                            </div>








                        </div>


                    </div>

                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="bot-history">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">AI Trading
                            History</span>
                    </h3>

                    <div class="w-full mt-5">

                        <div class="w-full ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600">
                            <div id="profitChart"></div>
                        </div>

                        <div class="w-full" id="bot-history-grid">
                            <div class="grid grid-cols-1 gap-3 mt-5">

                                @forelse ($histories as $history)
                                    <div
                                        class="w-full ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <div class="flex px-2 justify-between">
                                            <p class="flex space-x-1 p-3 items-center"><img
                                                    class="w-8 h-8 bg-white rounded-full"
                                                    src="{{ asset('storage/bots/' . $history->botActivation->bot->logo) }}"
                                                    alt="">
                                                <span>{{ $history->botActivation->bot->name }}</span>
                                                <span class="flex items-center space-x-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        class="w-4 h-4 text-orange-500" viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                    </svg>
                                                    <span>{{ $history->botActivation->user->username }}</span>
                                                </span>



                                            </p>
                                            <p>
                                                <span
                                                    class="view-chart cursor-pointer flex items-center bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all text-xs"
                                                    data-pair="{{ $history->pair }}">View Chart</span>
                                            </p>
                                        </div>
                                        <div class="w-full flex justify-between items-center p-2">


                                            <div class="">
                                                <div class="grid grid-cols-2 gap-1">
                                                    <p class="text-xs">Exit Time (UTC)</p>
                                                    <p class="text-purple-500 font-mono local-time">
                                                        {{ date('d-m-y H:i:s', $history->timestamp) }}
                                                    </p>

                                                    <p class="text-xs">Trading Pair</p>
                                                    <p class="text-purple-500 font-mono">{{ $history->pair }}</p>

                                                    <p class="text-xs">Entry Price</p>
                                                    <p class="text-purple-500 font-mono">{{ $history->entry_price }}</p>

                                                    <p class="text-xs">Exit Price</p>
                                                    <p class="text-purple-500 font-mono">{{ $history->exit_price }}</p>
                                                </div>

                                            </div>
                                            <div class="">
                                                <p class="flex justify-end items-center space-x-1">

                                                </p>
                                                @if ($history->profit < 0)
                                                    <p class="flex justify-end items-center text-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd"
                                                                d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </p>
                                                    <p class="flex justify-end items-center text-red-500">
                                                        -{{ formatAmount(str_replace('-', '', $history->profit)) }}
                                                    </p>
                                                    <p class="flex justify-end items-center text-red-500">
                                                        {{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                                    </p>
                                                @else
                                                    <p class="flex justify-end items-center text-green-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd"
                                                                d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </p>
                                                    <p class="flex justify-end items-center text-green-500">
                                                        +{{ formatAmount($history->profit) }}</p>
                                                    <p class="flex justify-end items-center text-green-500">
                                                        +{{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                                    </p>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="w-full flex justify-end">
                                            <a role="button"
                                                data-url="{{ route('admin.bots.history.delete', ['id' => $history->id]) }}"
                                                class="delete-bot-history flex items-center space-x-1 bg-red-500 px-2 py-1 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="w-4 h-4" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                                <span>Delete</span>
                                            </a>
                                        </div>


                                    </div>

                                @empty
                                    <div
                                        class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                            fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span>Empty Record. No trading history found!</span>
                                    </div>
                                @endforelse






                            </div>

                            <div class="w-full mt-5 flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="bot-history-grid">
                                {{ $histories->links('paginations.simple') }}
                            </div>
                        </div>


                    </div>

                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="add-new-bot">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Add New Bot</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">

                            <form action="{{ route('admin.bots.create') }}" method="post" enctype="multipart/form-data"
                                class="gen-form" data-action="reload">
                                @csrf

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                badge
                                            </span>
                                            <input type="text" placeholder="Name" id="name"
                                                class="theme1-text-input" name="name" required>
                                            <label for="name"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Name
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                        <p>Daily Return: <span class="text-orange-500" id="new_bot_slider_display"></span>
                                        </p>
                                        <div class="slider-input" id="new_bot_slider"></div>
                                        <input type="hidden" name="daily_min" id="new_bot_slider_min" value="1">
                                        <input type="hidden" name="daily_max" id="new_bot_slider_max" value="3">
                                    </div>
                                </div>

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-2 mb-2 mt-5 w-full">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                paid
                                            </span>
                                            <input type="number" step="any"
                                                placeholder="Min Portfolio ({{ site('currency') }})" id="portfolio_min"
                                                class="theme1-text-input" name="min" required>
                                            <label for="portfolio_min"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Min Portfolio
                                                ({{ site('currency') }})
                                            </label>

                                        </div>

                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                paid
                                            </span>
                                            <input type="number" step="any"
                                                placeholder="Max Portfolio ({{ site('currency') }})" id="portfolio_max"
                                                class="theme1-text-input" name="max" required>
                                            <label for="portfolio_max"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Max Portfolio
                                                ({{ site('currency') }})
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-2 gap-2 mb-2 mt-5 w-full">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                schedule
                                            </span>
                                            <input type="number" step="any" placeholder="Duration" id="duration"
                                                class="theme1-text-input" name="duration" required>
                                            <label for="duration"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Duration
                                            </label>

                                        </div>

                                        <div class="relative">
                                            <select class="theme1-text-input" name="duration_type" required>
                                                <option value="days" selected>Days</option>
                                                <option value="weeks">Weeks</option>
                                                <option value="months">Months</option>
                                                <option value="years">Years</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="w-full grid grid-cols-1  gap-5 mb-3">
                                    <label for="">Logo</label>
                                    <label
                                        class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                        for="logo">
                                        <span id="logo-preview"
                                            class="uploadIcon w-32 h-32 rounded-full  flex justify-center items-center"
                                            style="background-image: url({{ asset('storage/bots/pyron.png') }}); background-size: contain; background-repeat: no-repeat;">
                                            <span
                                                class="bg-transparent hover:bg-orange-600 border p-2 text-white rounded-full">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                            </span>
                                        </span>
                                    </label>
                                    <input class="hidden" type="file" accept="image/*" name="logo" id="logo"
                                        data-preview="logo-preview">


                                </div>


                                <div class="mt-10 mb-10 px-3 flex flex-start">
                                    <button type="submit" id="activateButton"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Save
                                    </button>
                                </div>


                            </form>






                        </div>



                    </div>

                </div>

                @foreach ($bots as $bot)
                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden"
                        id="{{ 'edit_bot_' . $bot->id }}">
                        <div class="w-full flex items-center justify-between">
                            <h3 class="capitalize  font-extrabold "><span class="border-b-2">Edit {{ $bot->name }}
                                    bot</span>
                            </h3>
                            <h3 class="flex justify-end">
                                <a role="button" data-url="{{ route('admin.bots.delete', ['id' => $bot->id]) }}"
                                    class="delete-bot flex items-center space-x-1 bg-red-500 px-2 py-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                    <span>Delete</span>
                                </a>
                            </h3>
                        </div>

                        <div class="w-full">


                            <div class="grid grid-cols-1 gap-3 mt-5">

                                <form action="{{ route('admin.bots.edit', ['id' => $bot->id]) }}" method="post"
                                    enctype="multipart/form-data" class="gen-form" data-action="reload">
                                    @csrf

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                            <div class="relative">

                                                <span class="theme1-input-icon material-icons">
                                                    badge
                                                </span>
                                                <input type="text" placeholder="Name" id="{{ 'name_' . $bot->id }}"
                                                    class="theme1-text-input" name="name" value="{{ $bot->name }}"
                                                    required>
                                                <label for="{{ 'name_' . $bot->id }}"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Name
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                            <p>Daily Return: <span class="text-orange-500"
                                                    id="{{ 'edit_bot_slider_' . $bot->id . '_display' }}">{{ $bot->daily_min . '%-' . $bot->daily_max . '%' }}</span>
                                            </p>
                                            <div class="slider-input" id="{{ 'edit_bot_slider_' . $bot->id }}"></div>
                                            <input type="hidden" name="daily_min"
                                                id="{{ 'edit_bot_slider_' . $bot->id . '_min' }}"
                                                value="{{ $bot->daily_min }}">
                                            <input type="hidden" name="daily_max"
                                                id="{{ 'edit_bot_slider_' . $bot->id . '_max' }}"
                                                value="{{ $bot->daily_max }}">
                                        </div>
                                    </div>

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-2 gap-2 mb-2 mt-5 w-full">
                                            <div class="relative">

                                                <span class="theme1-input-icon material-icons">
                                                    paid
                                                </span>
                                                <input type="number" step="any"
                                                    placeholder="Min Portfolio ({{ site('currency') }})"
                                                    id="{{ 'portfolio_min_' . $bot->id }}" class="theme1-text-input" name="min"
                                                    value="{{ $bot->min }}" required>
                                                <label for="{{ 'portfolio_min_' . $bot->id }}"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Min Portfolio
                                                    ({{ site('currency') }})
                                                </label>

                                            </div>

                                            <div class="relative">

                                                <span class="theme1-input-icon material-icons">
                                                    paid
                                                </span>
                                                <input type="number" step="any"
                                                    placeholder="Max Portfolio ({{ site('currency') }})"
                                                    id="{{ 'portfolio_max_' . $bot->id }}" class="theme1-text-input" name="max"
                                                    value="{{ $bot->max }}" required>
                                                <label for="{{ 'portfolio_max_' . $bot->id }}"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Max Portfolio
                                                    ({{ site('currency') }})
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-2 gap-2 mb-2 mt-5 w-full">
                                            <div class="relative">

                                                <span class="theme1-input-icon material-icons">
                                                    schedule
                                                </span>
                                                <input type="number" step="any" placeholder="Duration"
                                                    id="{{ 'duration_' . $bot->id }}" class="theme1-text-input" name="duration"
                                                    value="{{ $bot->duration }}" required>
                                                <label for="{{ 'duration_' . $bot->id }}"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Duration
                                                </label>

                                            </div>

                                            <div class="relative">
                                                <select class="theme1-text-input" name="duration_type" required>
                                                    <option value="days"
                                                        @if ($bot->duration_type == 'days') selected @endif>Days</option>
                                                    <option value="weeks"
                                                        @if ($bot->duration_type == 'weeks') selected @endif>Weeks</option>
                                                    <option value="months"
                                                        @if ($bot->duration_type == 'months') selected @endif>Months</option>
                                                    <option value="years"
                                                        @if ($bot->duration_type == 'years') selected @endif>Years</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-2 gap-2 mb-2 mt-5 w-full">

                                            <div class="relative">
                                                <span class="theme1-input-icon material-icons">
                                                    toggle_on
                                                </span>
                                                <select class="theme1-text-input" name="status" id="{{ 'status_' . $bot->id }}" required>
                                                    <option value="1"
                                                        @if ($bot->status == '1') selected @endif>Active</option>
                                                    <option value="0"
                                                        @if ($bot->status == '0') selected @endif>Inactive</option>

                                                </select>
                                                <label for="status"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Status
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full grid grid-cols-1  gap-5 mb-3">
                                        <label for="">Logo</label>
                                        <label
                                            class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                            for="{{ 'logo_' . $bot->id }}">
                                            <span id="{{ 'logo_' . $bot->id .'-preview' }}"
                                                class="uploadIcon w-32 h-32 rounded-full  flex justify-center items-center"
                                                style="background-image: url({{ asset('storage/bots/' . $bot->logo) }}); background-size: contain; background-repeat: no-repeat;">
                                                <span
                                                    class="bg-transparent hover:bg-orange-600 border p-2 text-white rounded-full">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <input class="hidden" type="file" accept="image/*" name="logo"
                                            id="{{ 'logo_' . $bot->id }}" data-preview="{{ 'logo_' . $bot->id .'-preview' }}">


                                    </div>


                                    <div class="mt-10 mb-10 px-3 flex flex-start">
                                        <button type="submit" id=""
                                            class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Save
                                        </button>
                                    </div>


                                </form>






                            </div>



                        </div>

                    </div>
                @endforeach



            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @foreach ($activations as $item)
        <script>
            $(document).ready(function() {
                var target = "{{ 'bot_timer_' . $item->id }}";
                var expires_in = {{ $item->expires_in }};

                // Get the current time in milliseconds
                var currentTime = new Date().getTime();

                // Calculate the remaining time in milliseconds
                var remainingTime = expires_in * 1000 - currentTime;

                // Calculate days, hours, minutes, and seconds
                var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                // Display the countdown
                var countdownElement = document.getElementById(target);
                countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

                // Update the countdown every second
                var countdownInterval = setInterval(function() {
                    if (remainingTime > 0) {
                        remainingTime -= 1000;

                        days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                        hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                        seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                        countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds +
                            "s";
                    } else {
                        clearInterval(countdownInterval);
                        countdownElement.innerHTML = "Expired";
                    }
                }, 1000);
            });
        </script>
    @endforeach



    {{-- currently used --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        var profits = {!! json_encode($profits) !!};
        var profitInt = profits.map(value => parseFloat((value * 1).toFixed(2)));

        Highcharts.chart('profitChart', {
            chart: {
                type: 'spline',
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
                text: '<span style="color: white">30 Days PNL</span>'
            },
            subtitle: {
                text: 'PNL Chart history for the last 30 days'
            },
            xAxis: {
                categories: {!! json_encode($days) !!},
                crosshair: true
            },
            yAxis: {
                // min: 0,
                title: {
                    text: '<span style="color: white">PNL ({{ site('currency') }})</span>'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size: 10px">{point.key} PNL</span><br/>',
                valuePrefix: '{{ site('currency') }}'
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

    {{-- view trading history chart --}}
    <script src="https://s3.tradingview.com/tv.js"></script>
    <script>
        $(document).on('click', '.view-chart', function(e) {
            var pair = $(this).data('pair'); // BTCUSDT

            //fetch trading view chart for the pair
            Swal.fire({
                html: `
                        <div class="mt-5">
                            <div id="chart-container"></div>
                        </div>
                        `,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCloseButton: true,
                allowEscapeKey: false, // Prevent closing by escape key
                allowOutsideClick: false, // Prevent closing by clicking backdrop
                willClose: () => {
                    //delete the previously generated qrcode
                    // $('#single_wallet_qrcode').html('');
                }
            });

            new TradingView.widget({
                // Define the container element for the widget
                container_id: 'chart-container', // Replace 'chart-container' with your actual container ID

                // Specify the symbol (pair) you want to display
                symbol: pair,

                // Specify the interval for the chart (e.g., '1D' for 1 day)
                interval: '1D',

                // Choose the style of the chart (e.g., 'Line' or 'Candles')
                style: 'Candles',

                // Specify the timezone for the chart
                timezone: 'Etc/UTC',
                theme: 'Dark'

            });

        });
    </script>

    {{-- delete bot --}}
    <script>
        $(document).on('click', '.delete-bot', function(e) {
            var clicked = $(this);
            var url = clicked.data('url');
            Swal.fire({
                html: `
                    <div class="mt-5">
                        <div>
                            <div class="ts-gray-1 text-white px-2 py-5 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                <form action="" method="post" id="deletebotForm" class="gen-form" data-action="reload">
                                    @csrf
                                    
                                    <p class="mb-3">Do you really want to delete this bot?</p>

                                    

                                    <div class="mt-10 mb-10 px-3 flex justify-center">
                                        <button type="submit" id="activateButton"
                                            class="bg-red-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Yes Delete!
                                        </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                `,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCancelButton: false,
                showCloseButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,



            });

            $('#deletebotForm').attr('action', url);
        });
    </script>

    {{-- manage activation --}}
    <script>
        $(document).on('click', '.edit-bot-activation', function(e) {
            var clicked = $(this);
            var url = clicked.data('url');
            Swal.fire({
                html: `
                    <div class="mt-5">
                        <div>
                            <div class="ts-gray-1 text-white px-2 py-5 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                <form action="" method="post" id="editBotActivationForm" class="gen-form" data-action="reload">
                                    @csrf
                                    
                                    <p class="mb-3">Manage Bot Activation</p>

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-1 mb-2 mt-5 w-full">

                                            <div class="relative">
                                                <span class="theme1-input-icon material-icons">
                                                    toggle_on
                                                </span>
                                                <select class="theme1-text-input" name="action" id="edit_bot_action_action" required>
                                                    <option selected disabled>Choose action</option>
                                                    <option value="suspend">Suspend</option>
                                                    <option value="reactivate">Reactivate</option>
                                                    <option value="delete">Delete</option>
                                                </select>
                                                <label for="edit_bot_action_action"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Action
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-10 mb-10 px-3 flex justify-center">
                                        <button type="submit" id="activateButton"
                                            class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Save Changes
                                        </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                `,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCancelButton: false,
                showCloseButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,



            });

            $('#editBotActivationForm').attr('action', url);
        });
    </script>

    {{-- delete history --}}
    <script>
        $(document).on('click', '.delete-bot-history', function(e) {
            var clicked = $(this);
            var url = clicked.data('url');
            Swal.fire({
                html: `
                    <div class="mt-5">
                        <div>
                            <div class="ts-gray-1 text-white px-2 py-5 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                <form action="" method="post" id="deleteHistoryForm" class="gen-form" data-action="reload">
                                    @csrf
                                    
                                    <p class="mb-3">Are you sure you want to delete this trading history?</p>

                                    

                                    <div class="mt-10 mb-10 px-3 flex justify-center">
                                        <button type="submit" id="activateButton"
                                            class="bg-red-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Save Changes
                                        </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                `,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCancelButton: false,
                showCloseButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,



            });

            $('#deleteHistoryForm').attr('action', url);
        });
    </script>
@endsection

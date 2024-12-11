@extends('layouts.user')

@section('contents')
    <div class="w-full p-3" id="pageContent">
        <div class="w-full lg:flex lg:gap-3" id="refresh">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <a data-target="withdrawals" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Withdrawal History</a>
                    <a data-target="new-withdrawal" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        New withdrawal</a>

                    @if (site('auto_withdraw') == 1)
                        <a data-target="withdrawal-wallets" role="button"
                            class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                            Withdrawal Wallets</a>
                    @endif



                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="withdrawals">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Withdrawal History</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Txn Ref" id="search-withdrawal-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-withdrawal-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Txn Ref
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="withdrawals">
                                        <a id="search-withdrawal-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('user.withdrawals.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            @forelse ($withdrawals as $withdrawal)
                                <div
                                    class="w-full flex justify-between items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <div class="">
                                        <p class="local-time">{{ date('d-m-y H:i:s', strtotime($withdrawal->created_at)) }}
                                        </p>
                                        <p class="font-bold text-mono">
                                            {{ formatAmount($withdrawal->amount - $withdrawal->fee) }}</p>
                                        <p class="flex space-x-1"><img class="w-5 h-5"
                                                src="{{ 'https://nowpayments.io' . $withdrawal->depositCoin->logo_url }}"
                                                alt="">
                                            <span>{{ $withdrawal->depositCoin->name }}</span>
                                        </p>
                                    </div>
                                    <div class="break-all">
                                        <p class="flex justify-end items-center space-x-1">
                                            @if ($withdrawal->status == 'pending')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span
                                                    class="text-gray-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                            @elseif ($withdrawal->status == 'approved')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                    fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                </svg>
                                                <span
                                                    class="text-green-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                            @elseif ($withdrawal->status == 'rejected' || $withdrawal->status == 'failed' || $withdrawal->status == 'refunded')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span
                                                    class="text-red-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span
                                                    class="text-orange-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                            @endif
                                        </p>
                                        <p class="flex justify-end flex items-center space-x-1">
                                            <span>{{ $withdrawal->converted_amount . ' ' . $withdrawal->depositCoin->code }}</span>
                                            <span class="text-xs text-orange-500">
                                                /{{ $withdrawal->depositCoin->network ?? $withdrawal->depositCoin->code }}</span>
                                        </p>
                                        <p class="flex justify-end clipboard cursor-pointer text-xs break-all"
                                            data-copy="{{ $withdrawal->wallet_address }}">
                                            {{-- <button data-link=""
                                                class="view-single-withdrawal flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white bg-purple-500 px-1 rounded-full text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                </svg>
                                                <span>View</span>
                                            </button> --}}
                                            {{ $withdrawal->wallet_address }}
                                        </p>

                                        <div class="w-full flex items-center justify-between">
                                            <h2>Txn Ref: </h2>
                                            <span class="font-bold clipboard cursor-pointer" data-copy="{{ $withdrawal->ref }}">{{ $withdrawal->ref }}</span>
                                            </span>
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
                                    <span>Empty Record. No withdrawal found!</span>
                                </div>
                            @endforelse





                            <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="withdrawals">
                                {{ $withdrawals->links('paginations.simple') }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card transition-all hidden" id="new-withdrawal">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">New withdrawal</span>
                    </h3>



                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all">
                        <div class="mt-5 hidden" id="display-new-withdrawal-information">
                            <div class="ts-gray-1 p-2 rounded w-full">

                                <div class="grid grid-cols-2 gap-2 text-mono text-sm break-all">
                                    <h2>Status </h2>
                                    <h2 class="font-bold"> <span id="display_withdrawal_status"></span>
                                    </h2>

                                    <h2>Valid Until </h2>
                                    <h2 class="font-bold"> <span id="display_withdrawal_valid_until"></span>
                                    </h2>

                                    <h2>Amount </h2>
                                    <h2 class="font-bold">{{ site('currency') }}<span
                                            id="display_withdrawal_amount"></span>
                                    </h2>

                                    <h2>Fee </h2>
                                    <h2 class="font-bold">{{ site('currency') }}<span id="display_withdrawal_fee"></span>
                                    </h2>


                                    <h2>Pay Amount</h2>
                                    <h2 class="font-bold"><span id="display_withdrawal_converted_amount"
                                            class="clipboard cursor-pointer" data-copy=""> </span> <span
                                            id="display_withdrawal_currency"></span>
                                    </h2>

                                    <h2>Network </h2>
                                    <h2 class="font-bold"><span id="display_withdrawal_network"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    <h2>Wallet Address </h2>
                                    <h2 class="font-bold"><span id="display_withdrawal_payment_wallet"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    <h2>Txn Ref </h2>
                                    <h2 class="font-bold"><span id="display_withdrawal_ref"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    {{-- 'status' => $withdrawal->status, --}}

                                </div>

                            </div>
                        </div>
                        <div class="mt-5" id="display-new-withdrawal">




                            <div class="flex  space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <div class="ts-gray-1 p-2 rounded w-full">
                                    <div class="grid grid-cols-2 gap-2 text-mono text-sm">
                                        <h2>Minimum withdrawal </h2>
                                        <h2 class="font-bold">:{{ formatAmount(site('min_withdrawal')) }}</h2>
                                        <h2>Maximum withdrawal </h2>
                                        <h2 class="font-bold">:{{ formatAmount(site('max_withdrawal')) }}</h2>

                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 ">
                                        <span class="uppercase text-orange-500">Warning: </span>
                                        Ensure your wallet address is valid. Withdrawals to wrong or invalid wallet address
                                        are not reversible.
                                    </p>
                                </div>

                            </div>

                            <div class="flex justify-end mb-5">
                                <div class="grid grid-cols-1 mb-2 mt-5 w-60">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Search Coins" id="coin-search-input"
                                            class="theme1-text-input">
                                        <label for="coin-search-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Search Coins
                                        </label>

                                    </div>
                                </div>
                            </div>

                            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 h-72 overflow-y-scroll overflow-x-hidden px-3 py-10"
                                id="coins">



                                @if (site('auto_withdraw') == 1)
                                    @if ($auto_wallets->count() > 0)
                                        @foreach ($coins as $coin)
                                            @if (array_key_exists($coin->code, $auto_wallets_array))
                                                <div data-target="{{ $coin->code }}"
                                                    data-wallet="{{ $auto_wallets_array[$coin->code] }}"
                                                    class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer coin"
                                                    data-currency_code="{{ $coin->code }}">
                                                    <div class="relative coin_select hidden" id="{{ $coin->code }}">
                                                        <div
                                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                                fill="currentColor" class="bi bi-check2-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                                <path
                                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="p-5">
                                                        <div class="text-gray-500 font-mono font-semibold text-center">
                                                            {{ $coin->name }}
                                                        </div>
                                                        <div class="px-2 flex item-center justify-between">
                                                            <div class="font-extrabold flex items-center space-x-1">
                                                                <img class="w-5 h-5"
                                                                    src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                                    alt="">
                                                                <span>{{ $coin->code }}</span>
                                                            </div>
                                                            @if ($coin->network)
                                                                <div>
                                                                    <div
                                                                        class="px-2 py-1 rounded-lg ts-gray-1 text-xs border border-slate-800 hover:border-slate-600">
                                                                        {{ $coin->network }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div
                                            class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                                fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            <span>You have not added any withdrawal wallet!</span>
                                        </div>
                                    @endif
                                @else
                                    @foreach ($coins as $coin)
                                        <div data-target="{{ $coin->code }}"
                                            class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer coin"
                                            data-currency_code="{{ $coin->code }}">
                                            <div class="relative coin_select hidden" id="{{ $coin->code }}">
                                                <div
                                                    class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" class="bi bi-check2-circle"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                        <path
                                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="p-5">
                                                <div class="text-gray-500 font-mono font-semibold text-center">
                                                    {{ $coin->name }}
                                                </div>
                                                <div class="px-2 flex item-center justify-between">
                                                    <div class="font-extrabold flex items-center space-x-1">
                                                        <img class="w-5 h-5"
                                                            src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                            alt="">
                                                        <span>{{ $coin->code }}</span>
                                                    </div>
                                                    @if ($coin->network)
                                                        <div>
                                                            <div
                                                                class="px-2 py-1 rounded-lg ts-gray-1 text-xs border border-slate-800 hover:border-slate-600">
                                                                {{ $coin->network }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @endif



                            </div>

                            <form action="{{ route('user.withdrawals.new') }}" method="post" id="withdrawalForm" class="gen-form" data-action="reload">
                                @csrf
                                <input type="hidden" name="currency_code" id="currency_code">
                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                paid
                                            </span>
                                            <input type="number" step="any"
                                                placeholder="Amount ({{ site('currency') }})" id="amount"
                                                class="theme1-text-input" name="amount" value="0" required>
                                            <label for="amount"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Amount
                                                ({{ site('currency') }})
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                paid
                                            </span>
                                            <input type="text" placeholder="Wallet Address" id="wallet_address"
                                                class="theme1-text-input" name="wallet_address" value="" required
                                                @if (site('auto_withdraw') == 1) readonly @endif>
                                            <label for="wallet_address"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">
                                                Wallet Address
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10 mb-10 px-3">
                                    <button type="submit"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Withdraw
                                        Now
                                    </button>
                                </div>
                            </form>






                        </div>


                    </div>

                </div>

                @if (site('auto_withdraw'))
                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card transition-all hidden"
                        id="withdrawal-wallets">
                        <h3 class="capitalize  font-extrabold "><span class="border-b-2">Withdrawal Wallets</span>
                        </h3>



                        <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all">

                            <div class="mt-5">
                                <div class="flex  space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    </svg>
                                    <div class="ts-gray-1 p-2 rounded w-full">

                                        <p class="text-xs text-gray-500 mt-2 ">
                                            <span class="uppercase text-orange-500">Warning: </span>
                                            For security reasons, newly added wallet address will be on security lock until
                                            the address is whitelisted. During this period, you wouldn't be able to use them
                                            for withdrawal.
                                        </p>
                                    </div>

                                </div>

                                @if ($auto_wallets->count() > 0)
                                    <div class="w-full grid grid-cols-1 gap-3 mb-5">
                                        @foreach ($auto_wallets as $wallet)
                                            <div class="w-full p-2 ts-gray-3 rounded-lg">
                                                <div class="w-full flex justify-between items-center">
                                                    <div class="font-extrabold flex items-center space-x-1">
                                                        <img class="w-5 h-5"
                                                            src="{{ 'https://nowpayments.io' . $wallet->depositCoin->logo_url }}"
                                                            alt="">
                                                        <span>{{ $wallet->depositCoin->code }}</span>
                                                    </div>

                                                    <div class="flex justify-end items-center space-x-2 text-xs">
                                                        <div class="flex space-x-1">
                                                            <span>Locked: </span>
                                                            @if ($wallet->whitelisted == 1)
                                                                <span class="text-green-500">No</span>
                                                            @else
                                                                <span class="text-red-500">Yes</span>
                                                            @endif
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="w-full flex justify-between items-center clipboard cursor-pointer"
                                                    data-copy="{{ $wallet->wallet_address }}">
                                                    <span class="text-xs md:text-sm">{{ $wallet->wallet_address }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        class="text-orange-500 w-5 h-5" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif



                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 mb-2 mt-5 w-60">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                search
                                            </span>
                                            <input type="text" placeholder="Search Coins" id="coin-search-input2"
                                                class="theme1-text-input">
                                            <label for="coin-search-input"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Search Coins
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 h-72 overflow-y-scroll overflow-x-hidden px-3 py-10"
                                    id="coins2">



                                    @foreach ($coins as $coin)
                                        @if (!array_key_exists($coin->code, $auto_wallets_array))
                                            <div data-target="{{ $coin->code . 2 }}"
                                                class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer coin2"
                                                data-currency_code="{{ $coin->code }}">
                                                <div class="relative coin_select2 hidden" id="{{ $coin->code . 2 }}">
                                                    <div
                                                        class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            fill="currentColor" class="bi bi-check2-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                            <path
                                                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="p-5">
                                                    <div class="text-gray-500 font-mono font-semibold text-center">
                                                        {{ $coin->name }}
                                                    </div>
                                                    <div class="px-2 flex item-center justify-between">
                                                        <div class="font-extrabold flex items-center space-x-1">
                                                            <img class="w-5 h-5"
                                                                src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                                alt="">
                                                            <span>{{ $coin->code }}</span>
                                                        </div>
                                                        @if ($coin->network)
                                                            <div>
                                                                <div
                                                                    class="px-2 py-1 rounded-lg ts-gray-1 text-xs border border-slate-800 hover:border-slate-600">
                                                                    {{ $coin->network }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach



                                </div>

                                <form action="{{ route('user.auto-wallets.new') }}" method="post" class="gen-form"
                                    data-action="reload">
                                    @csrf
                                    <input type="hidden" name="currency_code" id="currency_code2"
                                        class="theme1-text-input hidden">

                                    <div class="flex justify-end mb-5">
                                        <div class="grid grid-cols-1 mb-2 mt-5 w-full">
                                            <div class="relative">

                                                <span class="theme1-input-icon material-icons">
                                                    paid
                                                </span>
                                                <input type="text" placeholder="Wallet Address" id="wallet_address2"
                                                    class="theme1-text-input" name="wallet_address" value=""
                                                    required>
                                                <label for="wallet_address2"
                                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">
                                                    Wallet Address
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-10 mb-10 px-3">
                                        <button type="submit"
                                            class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all">
                                            Add
                                            Now
                                        </button>
                                    </div>
                                </form>






                            </div>


                        </div>

                    </div>
                @endif




            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // search withdrawal
        $(document).on('input keyup', '#search-withdrawal-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-withdrawal-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-withdrawal-button').attr('href', link);
        });

        let interval;
        //single withdrawal
        $(document).on('click', '.view-single-withdrawal', function(e) {
            var clicked = $(this);
            clicked.addClass('relative disabled');
            clicked.append('<span class="button-spinner"></span>');
            clicked.prop('disabled', true);
            var link = $(this).data('link');
            $('#single-display-new-withdrawal-information').removeClass('hidden');
            var html = $('#single-display-new-withdrawal-information');

            $.ajax({
                url: link,
                method: 'GET',
                success: function(response) {
                    var withdrawal = response.withdrawal;

                    Swal.fire({
                        html: `
                        <div class="mt-5" id="single-display-new-withdrawal-information">
                            <div>
                                <div class="ts-gray-1 p-2 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                    <div class="w-full flex justify-center items-center mb-2">
                                        <div id="single_wallet_qrcode" class="clipboard" data-copy=""></div>
                                    </div>
                                    <div class="w-full text-mono text-sm break-all">
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Status </h2>
                                            <h2 class="font-bold"> <span id="single_display_withdrawal_status"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Valid Until </h2>
                                            <h2 class="font-bold"> <span id="single_display_withdrawal_valid_until"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Amount </h2>
                                            <h2 class="font-bold">{{ site('currency') }}<span id="single_display_withdrawal_amount"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Fee </h2>
                                            <h2 class="font-bold">{{ site('currency') }}<span id="single_display_withdrawal_fee"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Pay Amount</h2>
                                            <h2 class="font-bold"><span id="single_display_withdrawal_converted_amount"
                                                    class="clipboard cursor-pointer" data-copy=""> </span> <span
                                                    id="single_display_withdrawal_currency"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Network </h2>
                                            <h2 class="font-bold"><span id="single_display_withdrawal_network"
                                                    class="clipboard cursor-pointer" data-copy=""></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Wallet Address </h2>
                                            <h2 class="font-bold"><span id="single_display_withdrawal_payment_wallet"
                                                    class="clipboard cursor-pointer" data-copy=""></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Txn Ref </h2>
                                            <h2 class="font-bold"><span id="single_display_withdrawal_ref" class="clipboard cursor-pointer"
                                                    data-copy=""></span>
                                            </h2>
                                        </div>
    
                                        
    
                                    </div>
    
                                </div>
                            </div>
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


                    // Loop through the withdrawal object's properties
                    for (var key in withdrawal) {
                        if (withdrawal.hasOwnProperty(key)) {
                            var value = withdrawal[key];
                            var element = $('#single_display_withdrawal_' + key);
                            if (element.length > 0) {
                                element.text(value);
                            }

                            //update the copy attribute
                            if (element.hasClass('clipboard')) {
                                element.attr('data-copy', value);
                            }


                        }
                    }

                    // create qrcode
                    var qrCodeElement = document.getElementById('single_wallet_qrcode');
                    var qrCode = new QRCode(qrCodeElement, {
                        text: withdrawal.payment_wallet,
                        width: 128,
                        height: 128
                    });

                    var walletQrCodeDiv = document.getElementById('single_wallet_qrcode');
                    walletQrCodeDiv.setAttribute('data-copy', withdrawal.payment_wallet);
                    var imageElement = walletQrCodeDiv.querySelector('img');
                    imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                        'hover:border-slate-600', 'cursor-pointer', 'p-1');
                    //imageElement.setAttribute('style', '');

                    //create a count down
                    var targetId = 'single_display_withdrawal_valid_until';
                    var targetDateString = withdrawal.valid_until;
                    if (interval) {
                        clearInterval(interval);
                    }

                    interval = setInterval(function() {
                        updateCountdown(targetId, targetDateString);
                    }, 1000);

                    // Check payment status
                    var ref = withdrawal.ref
                    setInterval(function() {
                        $.ajax({
                            url: "{{ url('/user/withdrawals/view') }}" + '/' +
                                withdrawal
                                .ref,
                            method: 'GET',
                            success: function(response) {
                                var status = response.withdrawal.status;
                                $('#single_display_withdrawal_status').html(status);


                            }
                        });
                    }, 10000);


                },
                complete: function() {
                    clicked.removeClass('disabled');
                    clicked.find('.button-spinner').remove();
                    clicked.prop('disabled', false);

                }
            });

        });
        // select the withdrawal coin
        $(document).on('click', ".coin", function(e) {
            $('.coin_select').addClass('hidden');
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');

            var currency_code = $(this).data('currency_code');
            var wallet_address = $(this).data('wallet');
            $("#currency_code").val(currency_code);
            if (wallet_address) {
                $("#wallet_address").val(wallet_address);
            }

        });

        // select the withdrawal wallet coin
        $(document).on('click', ".coin2", function(e) {
            $('.coin_select2').addClass('hidden');
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');

            var currency_code = $(this).data('currency_code');
            $("#currency_code2").val(currency_code);

        });


        // filter the coins
        $(document).on('input keyup', '#coin-search-input', function() {
            var searchText = $(this).val().toLowerCase();

            $('.coin').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });

        // filter the coins for new wallets
        $(document).on('input keyup', '#coin-search-input2', function() {
            var searchText = $(this).val().toLowerCase();

            $('.coin2').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });


        // handle withdrawal form
        $(document).on('submit', '#withdrawalFormbt', function(e) {
            e.preventDefault();
            var amount = $('#amount').val() * 1;
            var currency_code = $('#currency_code').val();
            var min_withdrawal = "{{ site('min_withdrawal') }}" * 1;
            var max_withdrawal = "{{ site('max_withdrawal') }}" * 1;
            var currency = "{{ site('currency') }}";

            //check the currency code
            var error = null;
            if (!currency_code) {
                error = 'You have not selected a withdrawal method';
            }

            //check min and max withdrawal
            if (amount < min_withdrawal) {
                error = 'Minimum withdrawal amount is ' + currency + min_withdrawal;
            }

            if (amount > max_withdrawal) {
                error = 'Maximum withdrawal amount is ' + currency + max_withdrawal;
            }

            if (error === null) {
                var form = $(this);
                var formData = new FormData(this);

                var submitButton = $(this).find('button[type="submit"]');
                submitButton.addClass('relative disabled');
                submitButton.append('<span class="button-spinner"></span>');
                submitButton.prop('disabled', true);
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {


                        loadPage(window.location.href, submitButton, '#pageContent');

                        $('html, body').animate({
                            scrollTop: 0 + 100
                        }, 800);
                        toastNotify('success', 'withdrawal request initated successfully');




                    },
                    error: function(xhr, status, error) {

                        if (status == 422) {
                            var errors = xhr.responseJSON.errors;

                            if (errors) {
                                $.each(errors, function(field, messages) {
                                    var fieldErrors = '';
                                    $.each(messages, function(index, message) {
                                        fieldErrors += message + '<br>';
                                    });


                                    Swal.fire({
                                        icon: 'error',
                                        html: fieldErrors,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer);
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer);
                                        }
                                    });
                                });
                            } else {
                                toastNotify('error', 'An Error occured, try again later');
                            }
                        } else {
                            toastNotify('error', 'Server Error occured, try again later');
                        }



                    },
                    complete: function() {
                        submitButton.removeClass('disabled');
                        submitButton.find('.button-spinner').remove();
                        submitButton.prop('disabled', false);

                    }
                });
            } else {

                toastNotify('error', error);

            }

        });
    </script>
@endsection

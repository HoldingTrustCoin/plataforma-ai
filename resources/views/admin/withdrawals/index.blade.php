@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">

                    <a data-target="withdrawals" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Withdrawals</a>

                    <a data-target="auto_wallets" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Auto Wallets</a>
                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="withdrawals">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">withdrawal History</span>
                    </h3>

                    <div class="w-full">
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mt-5">
                            <div
                                class="ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <div>
                                    <span>Approved</span>
                                </div>
                                <div class="">
                                    <span class="text-green-500">{{ formatAmount($summary['approved']) }}</span>
                                </div>
                            </div>

                            <div
                                class="ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <div>
                                    <span>Pending</span>
                                </div>
                                <div class="">

                                    <span class="text-orange-500">{{ formatAmount($summary['pending']) }}</span>
                                </div>
                            </div>

                            <div
                                class="ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <div>
                                    <span>Rejected</span>
                                </div>
                                <div class="">

                                    <span class="text-red-500">{{ formatAmount($summary['rejected']) }}</span>
                                </div>
                            </div>
                        </div>

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
                                            data-link="{{ route('admin.withdrawals.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            @forelse ($withdrawals as $withdrawal)
                                <div
                                    class="ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <div class="w-full flex justify-between">
                                        <p>User</p>
                                        <p>{{ $withdrawal->user->name }}</p>
                                    </div>
                                    <div class="w-full flex justify-between">
                                        <p class="text-xs">Txn ID</p>
                                        <p>{{ $withdrawal->ref }}</p>
                                    </div>
                                    <div class="w-full flex justify-between items-center">
                                        <div class="">
                                            <p class="local-time">
                                                {{ date('d-m-y H:i:s', strtotime($withdrawal->created_at)) }}
                                            </p>
                                            <p class="font-bold text-mono">{{ formatAmount($withdrawal->amount) }}</p>
                                            <p class="flex space-x-1"><img class="w-5 h-5"
                                                    src="{{ 'https://nowpayments.io' . $withdrawal->depositCoin->logo_url }}"
                                                    alt="">
                                                <span>{{ $withdrawal->depositCoin->name }}</span>
                                            </p>
                                        </div>
                                        <div class="">
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
                                                        fill="currentColor" class="bi bi-patch-check-fill"
                                                        viewBox="0 0 16 16">
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
                                            <p class="flex justify-end">
                                                {{ $withdrawal->converted_amount . ' ' . $withdrawal->depositCoin->code }}
                                            </p>
                                            <div class="w-full flex items-center justify-between">
                                                <h2>Txn Ref: </h2>
                                                <span class="clipboard cursor-pointer" data-copy="{{ $withdrawal->ref }}">{{ $withdrawal->ref }}</span>
                                                </span>
                                            </div>

                                            <div class="w-full flex items-center justify-between">
                                                <h2>Type: </h2>
                                                <span >{{ $withdrawal->type }}</span>
                                                </span>
                                            </div>

                                            <p class="flex justify-end">
                                                <button
                                                    data-link="{{ route('admin.withdrawals.view', ['id' => $withdrawal->id]) }}"
                                                    class="view-single-withdrawal flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white bg-purple-500 px-1 rounded-full text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                    <span>View</span>
                                                </button>
                                            </p>
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


                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="auto_wallets">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Auto Wallets</span>
                    </h3>

                    <div class="w-full">
                        @if ($balance_error)
                            <div
                                class="mt-5 w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span>{{ $balance_error }}</span>
                            </div>
                        @else
                            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mt-5">
                                @foreach ($balances as $name => $balance)
                                    <div
                                        class="ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <div class="flex justify-between items-center">
                                            <img class="w-5 h-5"
                                                src="{{ 'https://nowpayments.io/images/coins/' . $name . '.svg' }}"
                                                alt="">
                                            <span class="uppercase">{{ $name }}</span>
                                        </div>
                                        <div class="w-full flex justify-between text-xs">
                                            <span>Avl</span>
                                            <span class="text-green-500">{{ $balance['amount'] }}</span>
                                        </div>
                                        <div class="w-full flex justify-between text-xs">
                                            <span>Pending</span>
                                            <span class="text-orange-500">{{ $balance['pendingAmount'] }}</span>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        @endif


                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Wallet Address" id="search-wallet-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->w }}">
                                        <label for="search-wallet-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Wallet Address
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="auto_wallets">
                                        <a id="search-wallet-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('admin.withdrawals.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            @forelse ($auto_wallets as $withdrawal)
                                <div
                                    class="ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <div class="w-full flex justify-between">
                                        <p class="flex space-x-1"><img class="w-5 h-5"
                                                src="{{ 'https://nowpayments.io' . $withdrawal->depositCoin->logo_url }}"
                                                alt="">
                                            <span>{{ $withdrawal->depositCoin->name }}</span>
                                        </p>
                                        <p class="flex justify-end space-x-1 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="text-orange-500 w-5 h-5" viewBox="0 0 16 16">
                                                <path
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            </svg>
                                            <span>{{ $withdrawal->user->name }}</span>
                                        </p>
                                    </div>
                                    <div class="w-full break-all flex justify-between">
                                        <p class="font-bold text-mono clipboard cursor-pointer"
                                            data-copy="{{ $withdrawal->wallet_address }}">
                                            {{ $withdrawal->wallet_address }}</p>
                                        <p class="flex justify-end items-center space-x-1">
                                            @if ($withdrawal->whitelisted == 0)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                    fill="currentColor" class="bi bi-patch-check-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                </svg>
                                            @endif
                                        </p>
                                    </div>
                                    <form action="{{ route('admin.withdrawals.delete-wallet', ['id' => $withdrawal->id ]) }}" method="post" class="gen-form w-full flex justify-end" data-action="reload">
                                        @csrf
                                        <button
                                            type="submit"
                                            class=" flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white bg-red-500 px-2 py-1 rounded-full text-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-3 h-3" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                        
                                    </form>
                                



                                </div>

                            @empty
                                <div
                                    class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <span>Empty Record. No wallet found!</span>
                                </div>
                            @endforelse





                            <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="auto_wallets">
                                {{ $auto_wallets->links('paginations.simple') }}
                            </div>
                        </div>
                    </div>

                </div>





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

        // search wallet
        $(document).on('input keyup', '#search-wallet-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-wallet-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?w=' + encodedRef;
            $('#search-wallet-button').attr('href', link);
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
                                    <div class="w-full flex justify-between items-center mb-2">
                                        <div id="single_wallet_qrcode" class="clipboard" data-copy=""></div>
                                        <div class="ts-gray-3 rounded-lg p-1">
                                            <form action="" class="mt-5 gen-form" data-action="reload" id="processForm">
                                                @csrf
                                                <div class="grid grid-cols-1 mb-2">
                                                    <div class="relative">

                                                        <span class="theme1-input-icon material-icons">
                                                            merge_type
                                                        </span>
                                                        <select name="action" placeholder="Action" id="action" class="theme1-text-input"
                                                            {!! is_required('name', false) !!}>
                                                            <option disabled selected >Choose Action
                                                            </option>
                                                            <option value="approve" >Approve
                                                            </option>
                                                            <option value="reject" >Reject
                                                            </option>
                                                            <option value="delete" >Delete
                                                            </option>
                                                            
                                                        </select>
                                                        <label for="type" class="placeholder-label text-gray-300 ts-gray-2 px-2">Action
                                                            {!! is_required('name') !!}</label>
                                                        <span class="text-xs text-red-500">
                                                            @error('type')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <button type="submit" class="mt-5 mb-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Process</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="w-full text-mono text-sm break-all">
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Status </h2>
                                            <h2 class="font-bold"> <span id="single_display_withdrawal_status"></span>
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

                    var processAction = "{{ url('/') }}" + '/admin/withdrawals/' + withdrawal.id +
                        '/process';
                    $('#processForm').attr('action', processAction);
                    if (withdrawal.status !== "pending") {
                        $("#action option[value='approve'], #action option[value='reject']").remove();
                    }



                },
                complete: function() {
                    clicked.removeClass('disabled');
                    clicked.find('.button-spinner').remove();
                    clicked.prop('disabled', false);

                }
            });


        });
    </script>
@endsection

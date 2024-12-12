@extends('layouts.user')

@section('contents')
    <div class="w-full p-3">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <a data-target="deposits" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Deposit History</a>
                    <a data-target="new-deposit" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        New Deposit</a>





                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="deposits">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Deposit History</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Txn Ref" id="search-deposit-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-deposit-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Txn Ref
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="deposits">
                                        <a id="search-deposit-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('user.deposits.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            @forelse ($deposits as $deposit)
                                <div
                                    class="w-full flex justify-between items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span class="text-gray-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @elseif ($deposit->status == 'finished')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                    fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                </svg>
                                                <span class="text-green-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @elseif ($deposit->status == 'expired' || $deposit->status == 'failed' || $deposit->status == 'refunded')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span class="text-red-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span
                                                    class="text-orange-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @endif
                                        </p>
                                        <p class="flex justify-end">
                                            {{ $deposit->converted_amount . ' ' . $deposit->currency }}</p>
                                        <p class="flex justify-end">
                                            <button data-link="{{ route('user.deposits.view', ['ref' => $deposit->ref]) }}"
                                                class="view-single-deposit flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white bg-purple-500 px-1 rounded-full text-xs">
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

                            @empty
                                <div
                                    class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <span>Empty Record. No depsoit found!</span>
                                </div>
                            @endforelse





                            <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="deposits">
                                {{ $deposits->links('paginations.simple') }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card transition-all hidden" id="new-deposit">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">New Deposit</span>
                    </h3>



                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all">
                        <div class="mt-5 hidden" id="display-new-deposit-information">
                            <div class="ts-gray-1 p-2 rounded w-full">
                                <div class="w-full flex justify-center items-center mb-2">
                                    <div id="wallet_qrcode" class="clipboard" data-copy=""></div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-mono text-sm break-all">
                                    <h2>Status </h2>
                                    <h2 class="font-bold"> <span id="display_deposit_status"></span>
                                    </h2>

                                    <h2>Valid Until </h2>
                                    <h2 class="font-bold"> <span id="display_deposit_valid_until"></span>
                                    </h2>

                                    <h2>Amount </h2>
                                    <h2 class="font-bold">{{ site('currency') }}<span id="display_deposit_amount"></span>
                                    </h2>

                                    <h2>Fee </h2>
                                    <h2 class="font-bold">{{ site('currency') }}<span id="display_deposit_fee"></span>
                                    </h2>


                                    <h2>Pay Amount</h2>
                                    <h2 class="font-bold"><span id="display_deposit_converted_amount"
                                            class="clipboard cursor-pointer" data-copy=""> </span> <span
                                            id="display_deposit_currency"></span>
                                    </h2>

                                    <h2>Network </h2>
                                    <h2 class="font-bold"><span id="display_deposit_network"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    <h2>Wallet Address </h2>
                                    <h2 class="font-bold"><span id="display_deposit_payment_wallet"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    <h2>Txn Ref </h2>
                                    <h2 class="font-bold"><span id="display_deposit_ref" class="clipboard cursor-pointer"
                                            data-copy=""></span>
                                    </h2>

                                    {{-- 'status' => $deposit->status, --}}

                                </div>

                            </div>
                        </div>
                        <div class="mt-5" id="display-new-deposit">




                            <div class="flex  space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <div class="ts-gray-1 p-2 rounded w-full">
                                    <div class="grid grid-cols-2 gap-2 text-mono text-sm">
                                        <h2>Minimum Deposit </h2>
                                        <h2 class="font-bold">:{{ formatAmount(site('min_deposit')) }}</h2>
                                        <h2>Maximum Deposit </h2>
                                        <h2 class="font-bold">:{{ formatAmount(site('max_deposit')) }}</h2>
                                        <h2>Maximum Waiting Duration </h2>
                                        <h2 class="font-bold"> :7 Days</h2>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 ">
                                        <span class="uppercase text-orange-500">Warning: </span>
                                        After selecting your preferred payment method and entering the amount you want to
                                        deposit, a new wallet address will be generated for your deposit. Send only the
                                        specified token and network to the generated address or qrcode. Sending wrong token
                                        or sending to a wrong wallet address will lead to permanent.
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

                                @foreach ($coins as $coin)
                                    <div data-target="{{ $coin->code }}"
                                        class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer coin"
                                        data-currency_code="{{ $coin->code }}">
                                        <div class="relative coin_select hidden" id="{{ $coin->code }}">
                                            <div
                                                class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                    fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
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




                            </div>

                            <form action="{{ route('user.deposits.new') }}" method="post" id="depositForm">
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

                                <div class="mt-10 mb-10 px-3">
                                    <button type="submit"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Pay Now
                                    </button>
                                </div>
                            </form>






                        </div>


                    </div>

                </div>




            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // search deposit
        $(document).on('input keyup', '#search-deposit-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-deposit-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-deposit-button').attr('href', link);
        });

        let interval;
        //single deposit
        $(document).on('click', '.view-single-deposit', function(e) {
            var clicked = $(this);
            clicked.addClass('relative disabled');
            clicked.append('<span class="button-spinner"></span>');
            clicked.prop('disabled', true);
            var link = $(this).data('link');
            $('#single-display-new-deposit-information').removeClass('hidden');
            var html = $('#single-display-new-deposit-information');

            $.ajax({
                url: link,
                method: 'GET',
                success: function(response) {
                    var deposit = response.deposit;

                    Swal.fire({
                        html: `
                        <div class="mt-5" id="single-display-new-deposit-information">
                            <div>
                                <div class="ts-gray-1 p-2 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                    <div class="w-full flex justify-center items-center mb-2">
                                        <div id="single_wallet_qrcode" class="clipboard" data-copy=""></div>
                                    </div>
                                    <div class="w-full text-mono text-sm break-all">
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Status </h2>
                                            <h2 class="font-bold"> <span id="single_display_deposit_status"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Valid Until </h2>
                                            <h2 class="font-bold"> <span id="single_display_deposit_valid_until"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Amount </h2>
                                            <h2 class="font-bold">{{ site('currency') }}<span id="single_display_deposit_amount"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Fee </h2>
                                            <h2 class="font-bold">{{ site('currency') }}<span id="single_display_deposit_fee"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Pay Amount</h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_converted_amount"
                                                    class="clipboard cursor-pointer" data-copy=""> </span> <span
                                                    id="single_display_deposit_currency"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Network </h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_network"
                                                    class="clipboard cursor-pointer" data-copy=""></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Wallet Address </h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_payment_wallet"
                                                    class="clipboard cursor-pointer" data-copy=""></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Txn Ref </h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_ref" class="clipboard cursor-pointer"
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


                    // Loop through the deposit object's properties
                    for (var key in deposit) {
                        if (deposit.hasOwnProperty(key)) {
                            var value = deposit[key];
                            var element = $('#single_display_deposit_' + key);
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
                        text: deposit.payment_wallet,
                        width: 128,
                        height: 128
                    });

                    var walletQrCodeDiv = document.getElementById('single_wallet_qrcode');
                    walletQrCodeDiv.setAttribute('data-copy', deposit.payment_wallet);
                    var imageElement = walletQrCodeDiv.querySelector('img');
                    imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                        'hover:border-slate-600', 'cursor-pointer', 'p-1');
                    //imageElement.setAttribute('style', '');

                    //create a count down
                    var targetId = 'single_display_deposit_valid_until';
                    var targetDateString = deposit.valid_until;
                    if (interval) {
                        clearInterval(interval);
                    }
                    
                    interval = setInterval(function() {
                        updateCountdown(targetId, targetDateString);
                    }, 1000);

                    // Check payment status
                    var ref = deposit.ref
                    setInterval(function() {
                        $.ajax({
                            url: "{{ url('/user/deposits/view') }}" + '/' + deposit
                                .ref,
                            method: 'GET',
                            success: function(response) {
                                var status = response.deposit.status;
                                $('#single_display_deposit_status').html(status);


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
        // select the deposit coin
        $(document).on('click', ".coin", function(e) {
            $('.coin_select').addClass('hidden');
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');

            var currency_code = $(this).data('currency_code');
            $("#currency_code").val(currency_code);

        });


        // filter the coins
        $(document).on('input keyup', '#coin-search-input', function() {
            var searchText = $(this).val().toLowerCase();

            $('.coin').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });


        // handle deposit form
        $(document).on('submit', '#depositForm', function(e) {
            e.preventDefault();
            var amount = $('#amount').val() * 1;
            var currency_code = $('#currency_code').val();
            var min_deposit = "{{ site('min_deposit') }}" * 1;
            var max_deposit = "{{ site('max_deposit') }}" * 1;
            var currency = "{{ site('currency') }}";

            //check the currency code
            var error = null;
            if (!currency_code) {
                error = 'You have not selected a deposit method';
            }

            //check min and max deposit
            if (amount < min_deposit) {
                error = 'Minimum deposit amount is ' + currency + min_deposit;
            }

            if (amount > max_deposit) {
                error = 'Maximum deposit amount is ' + currency + max_deposit;
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
                        $('#amount').val(0);
                        var deposit = response.deposit;
                        $('#display-new-deposit').toggleClass('hidden');
                        $('#display-new-deposit-information').toggleClass('hidden');

                        // Loop through the deposit object's properties
                        for (var key in deposit) {
                            if (deposit.hasOwnProperty(key)) {
                                var value = deposit[key];
                                var element = $('#display_deposit_' + key);
                                if (element.length > 0) {
                                    element.text(value);
                                }

                                //update the copy attribute
                                if (element.hasClass('clipboard')) {
                                    element.attr('data-copy', value);
                                }


                            }
                        }


                        //create a count down
                        var targetId = 'display_deposit_valid_until';
                        var targetDateString = deposit.valid_until;
                        const interval = setInterval(function() {
                            updateCountdown(targetId, targetDateString);
                        }, 1000);

                        // create qrcode
                        var qrCodeElement = document.getElementById('wallet_qrcode');
                        var qrCode = new QRCode(qrCodeElement, {
                            text: deposit.payment_wallet,
                            width: 128,
                            height: 128
                        });

                        var walletQrCodeDiv = document.getElementById('wallet_qrcode');
                        walletQrCodeDiv.setAttribute('data-copy', deposit.payment_wallet);
                        var imageElement = walletQrCodeDiv.querySelector('img');
                        imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                            'hover:border-slate-600', 'cursor-pointer', 'p-1');

                        $('html, body').animate({
                            scrollTop: 0 + 100
                        }, 800);
                        toastNotify('success', 'Deposit request initated successfully');

                        // Check payment status
                        var ref = deposit.ref
                        setInterval(function() {
                            $.ajax({
                                url: "{{ url('/user/deposits/view') }}" + '/' + deposit
                                    .ref,
                                method: 'GET',
                                success: function(response) {
                                    var status = response.deposit.status;
                                    $('#display_deposit_status').html(status);
                                }
                            });
                        }, 10000);


                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });
                                toastNotify('error', fieldErrors);
                            });
                        } else {
                            toastNotify('error', 'An Error occured, try again later');
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

@extends('layouts.user')

@section('contents')
    <div class="w-full p-3" id="pageContent">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <a data-target="transfers" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        P2p History</a>
                    <a data-target="new-transfer" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        New P2p</a>





                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="transfers">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">transfer History</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Txn Ref" id="search-transfer-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-transfer-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Txn Ref
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="transfers">
                                        <a id="search-transfer-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('user.transfers.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            @forelse ($transfers as $transfer)
                                <div
                                    class="w-full flex justify-between items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <div class="">
                                        <p class="local-time">{{ date('d-m-y H:i:s', strtotime($transfer->created_at)) }}
                                        </p>
                                        <p class="">Ref: {{ $transfer->ref }}
                                        </p>
                                        @if ($transfer->sender_id == user()->id)
                                            <p class="">Fee: {{ formatAmount($transfer->fee) }}
                                            </p>
                                        @endif
                                        

                                    </div>
                                    <div class="break-all">
                                        <p class="font-bold text-mono flex justify-end">
                                            {{ formatAmount($transfer->amount) }}</p>
                                        <div class="flex justify-end items-center space-x-1">
                                            @if ($transfer->sender_id == user()->id)
                                                <div class="">
                                                    <p class="text-red-500 flex justify-end uppercase">Sent</p>
                                                    <p class="flex justify-end">to {{ $transfer->receiver_name }}</p>
                                                </div>
                                            @else
                                            <div class="">
                                                <p class="text-green-500 flex justify-end uppercase">Received</p>
                                                <p class="flex justify-end">from {{ $transfer->receiver_name }}</p>
                                            </div>
                                            @endif
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
                                    <span>Empty Record. No transfer found!</span>
                                </div>
                            @endforelse





                            <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="transfers">
                                {{ $transfers->links('paginations.simple') }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card transition-all hidden" id="new-transfer">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">New transfer</span>
                    </h3>



                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all">
                        <div class="mt-5 hidden" id="display-new-transfer-information">
                            <div class="ts-gray-1 p-2 rounded w-full">

                                <div class="grid grid-cols-2 gap-2 text-mono text-sm break-all">
                                    <h2>Status </h2>
                                    <h2 class="font-bold"> <span id="display_transfer_status"></span>
                                    </h2>

                                    <h2>Valid Until </h2>
                                    <h2 class="font-bold"> <span id="display_transfer_valid_until"></span>
                                    </h2>

                                    <h2>Amount </h2>
                                    <h2 class="font-bold">{{ site('currency') }}<span id="display_transfer_amount"></span>
                                    </h2>

                                    <h2>Fee </h2>
                                    <h2 class="font-bold">{{ site('currency') }}<span id="display_transfer_fee"></span>
                                    </h2>


                                    <h2>Pay Amount</h2>
                                    <h2 class="font-bold"><span id="display_transfer_converted_amount"
                                            class="clipboard cursor-pointer" data-copy=""> </span> <span
                                            id="display_transfer_currency"></span>
                                    </h2>

                                    <h2>Network </h2>
                                    <h2 class="font-bold"><span id="display_transfer_network"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    <h2>Wallet Address </h2>
                                    <h2 class="font-bold"><span id="display_transfer_payment_wallet"
                                            class="clipboard cursor-pointer" data-copy=""></span>
                                    </h2>

                                    <h2>Txn Ref </h2>
                                    <h2 class="font-bold"><span id="display_transfer_ref" class="clipboard cursor-pointer"
                                            data-copy=""></span>
                                    </h2>

                                    {{-- 'status' => $transfer->status, --}}

                                </div>

                            </div>
                        </div>
                        <div class="mt-5" id="display-new-transfer">




                            <div class="flex  space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="currentColor"
                                    class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <div class="ts-gray-1 p-2 rounded w-full">
                                    <div class="grid grid-cols-2 gap-2 text-mono text-sm">
                                        <h2>Minimum transfer </h2>
                                        <h2 class="font-bold">:{{ formatAmount(site('min_transfer')) }}</h2>
                                        <h2>Maximum transfer </h2>
                                        <h2 class="font-bold">:{{ formatAmount(site('max_transfer')) }}</h2>
                                        <h2>Fee </h2>
                                        <h2 class="font-bold">:{{ site('transfer_fee') }}%</h2>

                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 ">
                                        <span class="uppercase text-orange-500">Warning: </span>
                                        Confirm the receipient's full name before proceeding to make transfer.
                                    </p>
                                </div>

                            </div>


                            <form action="{{ route('user.transfers.user') }}" method="post" id="userForm"
                                class="hidden">
                                @csrf
                                <input type="text" name="username" id="userUsername" required>
                                <button type="submit" id="userFormButton"></button>
                            </form>



                            <form action="{{ route('user.transfers.new') }}" method="post" id="transferForm">
                                @csrf

                                <div class="grid grid-cols-1 gap-5 mb-2 mt-5 w-full">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            person
                                        </span>
                                        <input type="text" placeholder="Username" id="username"
                                            class="theme1-text-input" name="username" required>
                                        <label for="username"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Username
                                        </label>

                                    </div>

                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            person
                                        </span>
                                        <input type="text" placeholder="Full Name" id="fullname"
                                            class="theme1-text-input" name="fullname" required readonly>
                                        <label for="fullname" class="placeholder-label text-gray-300 ts-gray-2 px-2">Full
                                            Name
                                        </label>

                                    </div>

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


                                <div class="mt-10 mb-10 px-3">
                                    <button type="submit"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Transfer
                                        Now
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
        // search transfer
        $(document).on('input keyup', '#search-transfer-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-transfer-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-transfer-button').attr('href', link);
        });


        // search username
        $(document).on('change', '#username', function(e) {
            var username = $(this).val();
            $('#userUsername').val(username);
            $('#userFormButton').click();
        });


        // handle user form
        $(document).on('submit', '#userForm', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(this);
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#fullname').val(response.name)

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


                }
            });
        });







        // handle transfer form
        $(document).on('submit', '#transferForm', function(e) {
            e.preventDefault();
            var amount = $('#amount').val() * 1;
            var min_transfer = "{{ site('min_transfer') }}" * 1;
            var max_transfer = "{{ site('max_transfer') }}" * 1;
            var currency = "{{ site('currency') }}";

            //check the currency code
            var error = null;
            //check min and max transfer
            if (amount < min_transfer) {
                error = 'Minimum transfer amount is ' + currency + min_transfer;
            }

            if (amount > max_transfer) {
                error = 'Maximum transfer amount is ' + currency + max_transfer;
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


                        loadPage(form.attr('action'), submitButton, '#pageContent');

                        $('html, body').animate({
                            scrollTop: 0 + 100
                        }, 800);
                        toastNotify('success', response.message);




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

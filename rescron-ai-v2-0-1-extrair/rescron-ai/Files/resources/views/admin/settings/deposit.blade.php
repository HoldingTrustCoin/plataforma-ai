<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="deposit">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Deposit Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.deposit') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">
                    <p class="text-orange-500 text-xs">*NP = Now Payment</p>
                    <div class="relative">
                        <input type="text" name="np_api_key" placeholder="NP API KEY" id="np_api_key"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('NP_API_KEY')) }}">
                        <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP API KEY</label>
                        <span class="text-xs text-red-500">
                            @error('np_api_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="relative">
                        <input type="text" name="np_secret_key" placeholder="NP SECRET KEY" id="np_secret_key"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('NP_SECRET_KEY')) }}">
                        <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP SECRET
                            KEY</label>
                        <span class="text-xs text-red-500">
                            @error('np_secret_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <p class="text-orange-500 text-xs">*CP = Coinpayment</p>
                    <div class="relative">
                        <input type="text" name="cp_public_key" placeholder="CP Public Key" id="cp_public_key"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('COINPAYMENT_PUBLIC_KEY')) }}">
                        <label for="cp_public_key" class="placeholder-label text-gray-300 ts-gray-2 px-2">CP Public Key</label>
                        <span class="text-xs text-red-500">
                            @error('cp_public_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="relative">
                        <input type="text" name="cp_private_key" placeholder="CP Private Key" id="cp_private_key"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('COINPAYMENT_PRIVATE_KEY')) }}">
                        <label for="cp_private_key" class="placeholder-label text-gray-300 ts-gray-2 px-2">CP Private Key</label>
                        <span class="text-xs text-red-500">
                            @error('cp_private_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="relative">
                        <input type="text" name="cp_merchant_id" placeholder="CP Merchant ID" id="cp_merchant_id"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('COINPAYMENT_MARCHANT_ID')) }}">
                        <label for="cp_merchant_id" class="placeholder-label text-gray-300 ts-gray-2 px-2">CP Merchant ID</label>
                        <span class="text-xs text-red-500">
                            @error('cp_merchant_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="w-full md:w-1/2">
                        <div class="relative">


                            <select name="payment_processor" id="payment_processor" class="theme1-text-input pl-3" required>
                                <option value="coinpayment" @if (site('payment_processor') == 'coinpayment') selected @endif> Coinpayment </option>
                                <option value="nowpayment" @if (site('payment_processor') == 'nowpayment') selected @endif> NowPayment </option>
                                <option disabled> More Coming Soon...</option>
                            </select>
                            <label for="payment_processor" class="placeholder-label text-gray-300 ts-gray-2 px-2">Payment Processor</label>
                        </div>
                    </div>


                    <div class="relative grid grid-cols-1 lg:grid-cols-3 gap-5">

                        <div class="relative">
                            <input type="number" step="any" name="min_deposit" placeholder="Min Deposit"
                                id="min_deposit" class="theme1-text-input pl-3" required
                                value="{{ site('min_deposit') }}">
                            <label for="min_deposit" class="placeholder-label text-gray-300 ts-gray-2 px-2">Min Deposit
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('min_deposit')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="max_deposit" placeholder="Max Deposit"
                                id="max_deposit" class="theme1-text-input pl-3" required
                                value="{{ site('max_deposit') }}">
                            <label for="max_deposit" class="placeholder-label text-gray-300 ts-gray-2 px-2">Max Deposit
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('max_deposit')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="deposit_fee" placeholder="Deposit Fee"
                                id="deposit_fee" class="theme1-text-input pl-3" required
                                value="{{ site('deposit_fee') }}">
                            <label for="deposit_fee" class="placeholder-label text-gray-300 ts-gray-2 px-2">Deposit Fee
                                (%)</label>
                            <span class="text-xs text-red-500">
                                @error('deposit_fee')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                    </div>


                    <div class="mt-5">

                        <div class="flex justify-end mb-5">
                            <div class="grid grid-cols-1 mb-2 mt-5 w-60">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        search
                                    </span>
                                    <input type="text" placeholder="Search Coins" id="deposit-coin-search-input"
                                        class="theme1-text-input">
                                    <label for="deposit-coin-search-input"
                                        class="placeholder-label text-gray-300 ts-gray-2 px-2">Search Coins
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 h-72 overflow-y-scroll overflow-x-hidden px-3 py-10"
                            id="deposit-coins">

                            @foreach ($deposit_coins as $coin)
                                <div data-target="{{ 'deposit_' . $coin->code }}" 
                                    class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer deposit-coin"
                                    data-label="{{ 'deposit_coin_label' . $coin->id }}">
                                    <div class="relative deposit_coin_select @if ($coin->status == 0) hidden @endif"
                                        id="{{ 'deposit_' . $coin->code }}">
                                        <div
                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
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





                    </div>



                </div>

                <div class="text-blue-500 hidden">
                    @foreach ($deposit_coins as $coin)
                        <div>
                            <input type="checkbox" value="{{ $coin->id }}" name="deposit_coins[]"
                                id="{{ 'deposit_check_' . $coin->code }}"
                                @if ($coin->status == 1) checked @endif>
                            <label for="{{ 'deposit_check_' . $coin->code }}" id="{{ 'deposit_coin_label' . $coin->id }}">{{ $coin->code }}</label>
                        </div>
                    @endforeach
                </div>





                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                    <button type="submit" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                        Changes </button>
                </div>

            </form>

        </div>


    </div>

</div>


@push('scripts')
    <script>
        // select the deposit coin
        $(document).on('click', ".deposit-coin", function(e) {
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');
            var label = '#' + $(this).data('label');
            $(label).click();

        });


        // filter the coins
        $(document).on('input keyup', '#deposit-coin-search-input', function() {
            var searchText = $(this).val().toLowerCase();

            $('.deposit-coin').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });
    </script>
@endpush

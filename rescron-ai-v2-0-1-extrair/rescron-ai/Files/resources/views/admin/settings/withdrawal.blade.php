<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="withdrawal">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">withdrawal Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.withdrawal') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">


                    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="relative">


                            <select name="auto_withdraw" id="auto_withdraw" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('auto_withdraw') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('auto_withdraw') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="auto_withdraw" class="placeholder-label text-gray-300 ts-gray-2 px-2">Automatic
                                Withdrawal</label>

                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="min_withdrawal" placeholder="Min withdrawal"
                                id="min_withdrawal" class="theme1-text-input pl-3" required
                                value="{{ site('min_withdrawal') }}">
                            <label for="min_withdrawal" class="placeholder-label text-gray-300 ts-gray-2 px-2">Min
                                withdrawal
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('min_withdrawal')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="max_withdrawal" placeholder="Max withdrawal"
                                id="max_withdrawal" class="theme1-text-input pl-3" required
                                value="{{ site('max_withdrawal') }}">
                            <label for="max_withdrawal" class="placeholder-label text-gray-300 ts-gray-2 px-2">Max
                                withdrawal
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('max_withdrawal')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="withdrawal_fee" placeholder="withdrawal Fee"
                                id="withdrawal_fee" class="theme1-text-input pl-3" required
                                value="{{ site('withdrawal_fee') }}">
                            <label for="withdrawal_fee"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">withdrawal Fee
                                (%)</label>
                            <span class="text-xs text-red-500">
                                @error('withdrawal_fee')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                    </div>



                    <div class="w-full grid grid-cols-1 gap-3 @if (site('auto_withdraw') == 0) hidden @endif"
                        id="auto_withdraw_div">
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3">

                            <div class="relative">
                                <input type="number" step="any" name="wallet_lock_duration"
                                    placeholder="Security Lock (Days)" id="wallet_lock_duration"
                                    class="theme1-text-input pl-3" required value="{{ site('wallet_lock_duration') }}">
                                <label for="wallet_lock_duration"
                                    class="placeholder-label text-gray-300 ts-gray-2 px-2">Security Lock (Days)
                                </label>


                                <span class="text-xs text-red-500">
                                    @error('wallet_lock_duration')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="relative">
                                <input type="text" name="np_g2fa_secret" placeholder="NP G2FA Secret"
                                    id="np_g2fa_secret" class="theme1-text-input pl-3" required
                                    value="{{ demoMask(env('NP_G2FA_SECRET')) }}">
                                <label for="np_g2fa_secret" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP
                                    G2FA Secret
                                </label>

                                <span class="text-xs text-red-500">
                                    @error('np_g2fa_secret')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="relative">
                                <input type="text" name="np_email" placeholder="NP Email" id="np_email"
                                    class="theme1-text-input pl-3" required value="{{ demoMask(env('NP_EMAIL')) }}">
                                <label for="np_email" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP Email
                                </label>

                                <span class="text-xs text-red-500">
                                    @error('np_email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="relative">
                                <input type="text" name="np_password" placeholder="NP Password" id="np_password"
                                    class="theme1-text-input pl-3" required value="{{ demoMask(env('NP_PASSWORD')) }}">
                                <label for="np_password" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP
                                    Password
                                </label>

                                <span class="text-xs text-red-500">
                                    @error('np_password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full p-2 rounded-lg ts-gray-1 grid grid-cols-1 gap-5">
                            <p class="text-xs">Contact Nowpayment.io to whitelist these Server IPs for you. Most
                                hostings have two or more ips
                            </p>

                            <p class="text-xs text-orange-500">*For Automatic withdrawal to work, you should <span
                                    class="uppercase">disable wallet Whitelisting</span>. Contact nowpayment.io to
                                assist you with this.
                            </p>

                            <p class="text-xs text-blue-500">*Security Lock (Days): When users add new wallet, prevent
                                withdrawal for certain number of days</p>

                            <p class="text-xs text-blue-500">*NP G2FA Secret: This is your Nowpayment Two Factor authencation secret </p>
                            
                            
                            @foreach ($ips as $ip)
                                <p class="text-orange-500 clipboard w-full flex space-x-2 cursor-pointer"
                                    data-copy="{{ demoMask($ip) }}">
                                    <span>{{ demoMask($ip) }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z" />
                                    </svg>
                                </p>
                            @endforeach
                        </div>
                    </div>


                    <div class="mt-5">

                        <div class="flex justify-end mb-5">
                            <div class="grid grid-cols-1 mb-2 mt-5 w-60">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        search
                                    </span>
                                    <input type="text" placeholder="Search Coins"
                                        id="withdrawal-coin-search-input" class="theme1-text-input">
                                    <label for="withdrawal-coin-search-input"
                                        class="placeholder-label text-gray-300 ts-gray-2 px-2">Search Coins
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 h-72 overflow-y-scroll overflow-x-hidden px-3 py-10"
                            id="withdrawal-coins">

                            @foreach ($withdrawal_coins as $coin)
                                <div data-target="{{ 'withdrawal_' . $coin->code }}"
                                    class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer withdrawal-coin"
                                    data-label="{{ 'withdrawal_coin_label' . $coin->id }}">
                                    <div class="relative withdrawal_coin_select @if ($coin->can_withdraw == 0) hidden @endif"
                                        id="{{ 'withdrawal_' . $coin->code }}">
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





                    </div>



                </div>

                <div class="text-blue-500 hidden">
                    @foreach ($withdrawal_coins as $coin)
                        <div>
                            <input type="checkbox" value="{{ $coin->id }}" name="withdrawal_coins[]"
                                id="{{ 'withdrawal_check_' . $coin->code }}"
                                @if ($coin->can_withdraw == 1) checked @endif>
                            <label for="{{ 'withdrawal_check_' . $coin->code }}"
                                id="{{ 'withdrawal_coin_label' . $coin->id }}">{{ $coin->code }}</label>
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
        // select the withdrawal coin
        $(document).on('click', ".withdrawal-coin", function(e) {
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');
            var label = '#' + $(this).data('label');
            $(label).click();

        });


        // filter the coins
        $(document).on('input keyup', '#withdrawal-coin-search-input', function() {
            var searchText = $(this).val().toLowerCase();

            $('.withdrawal-coin').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });

        $(document).on('change', '#auto_withdraw', function() {
            var auto_withdraw = $(this).val() * 1;

            if (auto_withdraw == 0) {
                $('#auto_withdraw_div').addClass('hidden');
            } else {
                $('#auto_withdraw_div').removeClass('hidden');
            }
        });
    </script>
@endpush

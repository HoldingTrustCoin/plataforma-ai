@php
    // $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $trading_days = json_decode(site('trading_days'));
@endphp


<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="bot-setting">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Bot Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.bot') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">


                    <div class="relative grid grid-cols-1 gap-5">

                        <div class="relative">
                            <input type="number" step="any" name="bot_min_trade" placeholder="Minimum Trade"
                                id="bot_min_trade" class="theme1-text-input pl-3" required
                                value="{{ site('bot_min_trade') }}">
                            <label for="bot_min_trade" class="placeholder-label text-gray-300 ts-gray-2 px-2">Minimum
                                Trade</label>
                            <span class="text-xs text-blue-500">
                                Minimum number of times a bot can trade daily for a user
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="bot_max_trade" placeholder="Maximum Trade"
                                id="bot_max_trade" class="theme1-text-input pl-3" required
                                value="{{ site('bot_max_trade') }}">
                            <label for="bot_max_trade" class="placeholder-label text-gray-300 ts-gray-2 px-2">Maximum
                                Trade</label>
                            <span class="text-xs text-blue-500">
                                Maximum number of times a bot can trade daily for a user
                            </span>
                        </div>

                        <div class="relative">


                            <select name="bot_compounding" id="bot_compounding" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('bot_compounding') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('bot_compounding') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="bot_compounding" class="placeholder-label text-gray-300 ts-gray-2 px-2">Bot
                                Compounding</label>
                            <span class="text-xs text-blue-500">
                                If you enable this, the bot will trade with portfolio balance instead of the original
                                capital
                            </span>
                        </div>


                    </div>


                    <div class="mt-5">

                        <p class="font-bold font-mono text-orange-500">Trading Days</p>
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5  px-3 py-10"
                            id="trading-days">

                            @foreach ($days as $key => $day)
                                <div data-target="{{ 'day_' . $key }}" 
                                    class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer trading-day"
                                    data-label="{{ 'day_coin_label' . $key }}">
                                    <div class="relative @if (!in_array($day, $trading_days)) hidden @endif"
                                        id="{{ 'day_' . $key }}">
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
                                        
                                        <div class="px-2 flex item-center justify-center">
                                            <div class="font-extrabold flex items-center space-x-1">
                                                
                                                <span>{{ strtoupper($day) }}</span>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            @endforeach




                        </div>





                    </div>



                </div>

                <div class="text-blue-500 hidden">
                    @foreach ($days as $key => $day)
                        <div>
                            <input type="checkbox" value="{{ $day }}" name="days[]"
                                id="{{ 'day_check_' . $key }}"
                                @if (in_array($day, $trading_days)) checked @endif>
                            <label for="{{ 'day_check_' . $key }}" id="{{ 'day_coin_label' . $key }}">{{ $day }}</label>
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
        $(document).on('click', ".trading-day", function(e) {
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');
            var label = '#' + $(this).data('label');
            $(label).click();

        });
    </script>
@endpush

<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="core">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Core Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.core') }}" class="mt-5 gen-form" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">
                    <div class="relative">
                        <input type="text" name="name" placeholder="Name" id="name" class="theme1-text-input pl-3"
                            required value="{{ site('name') }}">
                        <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">Name</label>
                        <span class="text-xs text-red-500">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="relative">
                            <select name="currency" id="currency" class="theme1-text-input pl-3" required>
                                @foreach (currencies() as $currency)
                                    <option data-symbol="{{ $currency->symbol ?? $currency->code }}"
                                        value="{{ strtoupper($currency->code) }}"
                                        @if (strtoupper($currency->code) == site('currency')) selected @endif>
                                        {{ strtoupper($currency->code) }} </option>
                                @endforeach
                            </select>
                            <label for="currency"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Currency</label>
                        </div>

                        <div class="relative">
                            <input type="text" name="currency_symbol" id="currency_symbol" class="theme1-text-input pl-3"
                                value="{{ site('currency_symbol') }}" required readonly>
                            <label for="currency_symbol" class="placeholder-label text-gray-300 ts-gray-2 px-2">Currency
                                Symbol</label>
                        </div>
                    </div>


                    <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="">

                            <select name="currency_position" id="currency_position" class="theme1-text-input pl-3" required>
                                <option value="left"  @if ( site('currency_position') == 'left') selected @endif> Left </option>
                                <option value="right"  @if ( site('currency_position') == 'right') selected @endif> Right </option>
                            </select>
                            <label for="currency_position"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Currency Position</label>
                        </div>

                        <div class="relative">


                            <select name="use_sign" id="use_sign" class="theme1-text-input pl-3" required>
                                <option value="1"  @if ( site('use_sign') == 1) selected @endif> Yes </option>
                                <option value="0"  @if ( site('use_sign') == 0) selected @endif> No </option>
                            </select>
                            <label for="use_sign"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Use Symbol</label>
                        </div>
                    </div>

                    <div class="relative">
                        <label for="">Logo (150x150)</label>
                        <label
                            class="w-full font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                            for="logo_square">
                            <span id="logo_square-preview"
                                class="uploadIcon w-32 h-32 rounded-full  flex justify-center items-center"
                                style="background-image: url({{ asset('assets/images/' . site('logo_square')) }}); background-size: contain; background-repeat: no-repeat;">
                                <span class="bg-transparent hover:bg-orange-600 border p-2 text-white rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        </label>
                        <input class="hidden" type="file" accept="image/*" name="logo_square" id="logo_square"
                            data-preview="logo_square-preview">


                    </div>


                    <div class="relative">
                        <label for="">Logo (300x100)</label>
                        <label
                            class="w-full font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                            for="logo_rec">
                            <span id="logo_rec-preview"
                                class="uploadIcon w-64 h-20 rounded-full  flex justify-center items-center"
                                style="background-image: url({{ asset('assets/images/' . site('logo_rec')) }}); background-size: contain; background-repeat: no-repeat;">
                                <span class="bg-transparent hover:bg-orange-600 border p-2 text-white rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        </label>
                        <input class="hidden" type="file" accept="image/*" name="logo_rec" id="logo_rec"
                            data-preview="logo_rec-preview">


                    </div>


                    <div class="relative">
                        <label for="">Favicon (32x32)</label>
                        <label
                            class="w-full font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                            for="favicon">
                            <span id="favicon-preview"
                                class="uploadIcon w-10 h-10 rounded-full  flex justify-center items-center"
                                style="background-image: url({{ asset('assets/images/' . site('favicon')) }}); background-size: contain; background-repeat: no-repeat;">
                                <span class="bg-transparent hover:bg-orange-600 border p-2 text-white rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        </label>
                        <input class="hidden" type="file" accept="image/*" name="favicon" id="favicon"
                            data-preview="favicon-preview">


                    </div>


                    <div class="relative">
                        <input type="text" name="homepage" placeholder="Custom Homepage" id="homepage" class="theme1-text-input pl-3"
                             value="{{ site('homepage') }}">
                        <label for="homepage" class="placeholder-label text-gray-300 ts-gray-2 px-2">Custom Homepage</label>
                        <span class="text-xs text-red-500">
                            @error('homepage')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>





                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                    <button type="submit"
                        class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                        Changes </button>
                </div>

            </form>

        </div>


    </div>

</div>



@push('scripts')
    <script>
        const currencySelect = document.getElementById('currency');
        const currencySymbolInput = document.getElementById('currency_symbol');

        currencySelect.addEventListener('change', function() {
            const selectedOption = currencySelect.options[currencySelect.selectedIndex];
            const dataSymbol = selectedOption.getAttribute('data-symbol');
            currencySymbolInput.value = dataSymbol;
        });
    </script>
@endpush

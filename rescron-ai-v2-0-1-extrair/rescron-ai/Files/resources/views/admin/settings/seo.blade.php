<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="seo">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">SEO Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.seo') }}" class="mt-5 gen-form" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">

                    <div class="relative">
                        <select name="robots" id="robots" class="theme1-text-input pl-3" required>
                            <option value="index" @if (site('robots') == 'index') selected @endif> Index</option>
                            <option value="noindex" @if (site('robots') == 'noindex') selected @endif> Noindex</option>
                        </select>
                        <label for="robots"
                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Robots</label>
                    </div>

                    
                    <div class="relative">
                        <label for="seo_description" class="">SEO Description</label>

                        <textarea  name="seo_description"  id="seo_description" class="theme1-text-input pl-3 h-32"
                            required>{{ site('seo_description') }}</textarea>
                        
                        
                    </div>

                    


                    

                    


                    <div class="relative">
                        <label for="">Cover Photo</label>
                        <label
                            class="w-full font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                            for="cover">
                            <span id="cover-preview"
                                class="uploadIcon w-64 h-44 rounded-full  flex justify-center items-center"
                                style="background-image: url({{ asset('assets/images/' . site('cover')) }}); background-size: contain; background-repeat: no-repeat;">
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
                        <input class="hidden" type="file" accept="image/*" name="cover" id="cover"
                            data-preview="cover-preview">


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

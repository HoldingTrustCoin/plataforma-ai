<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="referral">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Referral Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.referral') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf
                <p class="text-blue-500 text-xs">Referral bonus up to 10th level is supported, set the level to 0 if you dont want to give bonus to that level</p>

                <div class="grid grid-cols-1 gap-5 mt-5">
                    

                    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach (json_decode(site('bonus')) as $level => $bonus)
                            <div class="relative">
                                <input type="number" step="any" name="bonus[]" placeholder="level {{ $level + 1 }}"
                                    id="{{ 'level_' . ($level + 1) }}" class="theme1-text-input pl-3" required
                                    value="{{ $bonus }}">
                                <label for="{{ 'level_' . ($level + 1) }}" class="placeholder-label text-gray-300 ts-gray-2 px-2">
                                    Level {{ $level + 1 }} (%)
                                </label>
                                
                            </div>
                        @endforeach
                    </div>
                </div>







                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                    <button type="submit" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                        Changes </button>
                </div>

            </form>

        </div>


    </div>

</div>

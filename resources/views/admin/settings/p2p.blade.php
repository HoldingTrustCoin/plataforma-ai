<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="p2p">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">P2P Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.transfer') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">


                    <div class="relative grid grid-cols-1 gap-5">

                        <div class="relative">
                            <input type="number" step="any" name="min_transfer" placeholder="Min transfer"
                                id="min_transfer" class="theme1-text-input pl-3" required
                                value="{{ site('min_transfer') }}">
                            <label for="min_transfer" class="placeholder-label text-gray-300 ts-gray-2 px-2">Min transfer
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('min_transfer')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="max_transfer" placeholder="Max transfer"
                                id="max_transfer" class="theme1-text-input pl-3" required
                                value="{{ site('max_transfer') }}">
                            <label for="max_transfer" class="placeholder-label text-gray-300 ts-gray-2 px-2">Max transfer
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('max_transfer')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="transfer_fee" placeholder="transfer Fee"
                                id="transfer_fee" class="theme1-text-input pl-3" required
                                value="{{ site('transfer_fee') }}">
                            <label for="transfer_fee" class="placeholder-label text-gray-300 ts-gray-2 px-2">transfer Fee
                                (%)</label>
                            <span class="text-xs text-red-500">
                                @error('transfer_fee')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


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

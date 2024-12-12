<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="contact">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Email Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.contact') }}" method="POST" class="mt-5 gen-form" data-action="none" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">
                    <div class="grid grid-cols-1 gap-5">
                        <div class="relative">
                            <input type="text" name="address" placeholder="Address" id="c_address"
                                class="theme1-text-input pl-3" value="{{ site('address') }}">
                            <label for="c_address" class="placeholder-label text-gray-300 ts-gray-2 px-2">Address</label>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 gap-5">
                        <div class="relative">
                            <input type="text" name="city" placeholder="City" id="c_city"
                                class="theme1-text-input pl-3" value="{{ site('city') }}">
                            <label for="c_city" class="placeholder-label text-gray-300 ts-gray-2 px-2">City</label>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 gap-5">
                        <div class="relative">
                            <input type="text" name="state" placeholder="State" id="c_state"
                                class="theme1-text-input pl-3" value="{{ site('state') }}">
                            <label for="c_state" class="placeholder-label text-gray-300 ts-gray-2 px-2">State</label>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 gap-5">
                        <div class="relative">
                            <input type="text" name="country" placeholder="Country" id="c_country"
                                class="theme1-text-input pl-3" value="{{ site('country') }}">
                            <label for="c_country" class="placeholder-label text-gray-300 ts-gray-2 px-2">Country</label>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 gap-5">
                        <div class="relative">
                            <input type="text" name="phone" placeholder="Phone" id="c_phone"
                                class="theme1-text-input pl-3" value="{{ site('phone') }}">
                            <label for="c_phone" class="placeholder-label text-gray-300 ts-gray-2 px-2">Phone</label>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 gap-5">
                        <div class="relative">
                            <input type="email" name="email" placeholder="Email" id="c_email"
                                class="theme1-text-input pl-3" value="{{ site('email') }}">
                            <label for="c_email" class="placeholder-label text-gray-300 ts-gray-2 px-2">Email</label>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1">
                        <label for="livechat" class="text-gray-300 ts-gray-2 px-2">Livechat</label>
                        <div class="relative">
                            <textarea  name="livechat" placeholder="Livechat" id="c_livechat"
                                class="theme1-textarea  pl-3">{!! json_decode(site('livechat')) !!}</textarea>
                            
                        </div>
                    </div>
    
                    <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                        <button type="submit" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                            Changes </button>
                    </div>
                </div>

            </form>

            

        </div>


    </div>

</div>

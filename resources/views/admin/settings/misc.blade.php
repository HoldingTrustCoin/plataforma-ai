<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="misc">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Misc Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.misc') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">


                    <div class="relative grid grid-cols-1 gap-5">

                        <div class="relative">


                            <select name="preloader" id="preload" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('preloader') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('preloader') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="preload" class="placeholder-label text-gray-300 ts-gray-2 px-2">Preloader</label>
                            
                        </div>

                        <div class="relative">
                            <input type="number"  name="pagination" placeholder="Pagination"
                                id="pagination" class="theme1-text-input pl-3" required
                                value="{{ site('pagination') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2">Pagination</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="facebook" placeholder="Facebook"
                                id="facebook" class="theme1-text-input pl-3"
                                value="{{ site('facebook') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2">Facebook</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="facebook" placeholder="Facebook"
                                id="facebook" class="theme1-text-input pl-3"
                                value="{{ site('facebook') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2">Facebook</label>
                            
                        </div>


                        <div class="relative">
                            <input type="text"  name="instagram" placeholder="instagram"
                                id="instagram" class="theme1-text-input pl-3"
                                value="{{ site('instagram') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">instagram</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="twitter" placeholder="twitter"
                                id="twitter" class="theme1-text-input pl-3"
                                value="{{ site('twitter') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">twitter</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="linkedin" placeholder="linkedin"
                                id="linkedin" class="theme1-text-input pl-3"
                                value="{{ site('linkedin') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">linkedin</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="youtube" placeholder="youtube"
                                id="youtube" class="theme1-text-input pl-3"
                                value="{{ site('youtube') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">youtube</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="pinterest" placeholder="pinterest"
                                id="pinterest" class="theme1-text-input pl-3"
                                value="{{ site('pinterest') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">pinterest</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="snapchat" placeholder="snapchat"
                                id="snapchat" class="theme1-text-input pl-3"
                                value="{{ site('snapchat') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">snapchat</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="tiktok" placeholder="tiktok"
                                id="tiktok" class="theme1-text-input pl-3"
                                value="{{ site('tiktok') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">tiktok</label>
                            
                        </div>


                        <div class="relative">
                            <input type="text"  name="reddit" placeholder="reddit"
                                id="reddit" class="theme1-text-input pl-3"
                                value="{{ site('reddit') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">reddit</label>
                            
                        </div>

                        <div class="relative">
                            <input type="text"  name="whatsapp" placeholder="whatsapp"
                                id="whatsapp" class="theme1-text-input pl-3"
                                value="{{ site('whatsapp') }}">
                            <label for="pagination" class="placeholder-label text-gray-300 ts-gray-2 px-2 capitalize">whatsapp</label>
                            
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




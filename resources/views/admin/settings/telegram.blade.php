<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="telegram">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Telegram notification Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.telegram') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">


                    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="relative">
                            <input type="text" name="telegram_bot_token" placeholder="Telegram Bot Token"
                                id="telegram_bot_token" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('TELEGRAM_BOT_TOKEN')) }}">
                            <label for="telegram_bot_token" class="placeholder-label text-gray-300 ts-gray-2 px-2">Telegram Bot Token
                            </label>

                        </div>

                        <div class="relative">
                            <input type="text" name="telegram_chat_id" placeholder="Telegram Channel ID"
                                id="telegram_chat_id" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('TELEGRAM_CHAT_ID')) }}">
                            <label for="telegram_chat_id" class="placeholder-label text-gray-300 ts-gray-2 px-2">Telegram Channel ID
                            </label>

                        </div>

                        <div class="relative">
                            <input type="text" name="telegram_chat__group_id" placeholder="Telegram Group ID"
                                id="telegram_chat_group_id" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('TELEGRAM_CHAT_GROUP_ID')) }}">
                            <label for="telegram_chat_group_id" class="placeholder-label text-gray-300 ts-gray-2 px-2">Telegram Group ID
                            </label>

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



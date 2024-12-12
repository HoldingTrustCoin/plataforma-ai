<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="email">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Email Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.email') }}" method="POST" class="mt-5 gen-form" data-action="none" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">
                    <div class="relative">
                        <input type="text" name="host" placeholder="SMTP Host" id="host"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('MAIL_HOST')) }}">
                        <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">SMTP Host</label>
                        <span class="text-xs text-red-500">
                            @error('host')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-5">

                        <div class="relative">


                            <select name="encryption" id="encryption" class="theme1-text-input pl-3" required>
                                <option value="ssl" @if (env('MAIL_ENCRYPTION') == 'ssl') selected @endif> SSL </option>
                                <option value="tls" @if (env('MAIL_ENCRYPTION') == 'tls') selected @endif> TLS </option>
                                <option value="null" @if (env('MAIL_ENCRYPTION') == null) selected @endif> None </option>
                            </select>
                            <label for="use_sign" class="placeholder-label text-gray-300 ts-gray-2 px-2">SMTP Encryption</label>
                        </div>

                        <div class="relative">
                            <input type="number" name="port" placeholder="SMTP Port" id="port"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('MAIL_PORT')) }}">
                            <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">SMTP Port</label>
                            <span class="text-xs text-red-500">
                                @error('port')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>


                    <div class="relative">
                        <input type="text" name="username" placeholder="SMTP Username" id="username"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('MAIL_USERNAME')) }}">
                        <label for="username" class="placeholder-label text-gray-300 ts-gray-2 px-2">SMTP Username</label>
                        <span class="text-xs text-red-500">
                            @error('username')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="relative">
                        <input type="password" name="password" placeholder="SMTP Password" id="password"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('MAIL_PASSWORD')) }}">
                        <label for="password" class="placeholder-label text-gray-300 ts-gray-2 px-2">SMTP Password</label>
                        <span class="text-xs text-red-500">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="relative">
                        <input type="text" name="from_name" placeholder="From Name" id="from_name"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('MAIL_FROM_NAME')) }}">
                        <label for="from_name" class="placeholder-label text-gray-300 ts-gray-2 px-2">From Name</label>
                        <span class="text-xs text-red-500">
                            @error('from_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="relative">
                        <input type="email" name="from_email" placeholder="From Email" id="from_email"
                            class="theme1-text-input pl-3" required value="{{ env('MAIL_FROM_ADDRESS') }}">
                        <label for="from_email" class="placeholder-label text-gray-300 ts-gray-2 px-2">From Email</label>
                        <span class="text-xs text-red-500">
                            @error('from_email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                </div>





                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                    <button type="submit" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                        Changes </button>
                </div>

            </form>

            <form action="{{ route('admin.settings.email-test') }}" method="POST" class="mt-5 gen-form" data-action="reset"
                enctype="multipart/form-data">
                @csrf

                <div class="flex justify-between p-2 rounded-lg ts-gray-3 items-center">
                    <div class="relative w-3/4">
                        <input type="email" name="email" placeholder="Email" id="email-test"
                            class="theme1-text-input pl-3" required>
                        <label for="email-test" class="placeholder-label text-gray-300 ts-gray-2 px-2">Email</label>
                        <span class="text-xs text-red-500">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button type="submit" class="bg-purple-500 px-2 py-1 rounded-lg transition-all">Test Email</button>



                </div>

            </form>

        </div>


    </div>

</div>

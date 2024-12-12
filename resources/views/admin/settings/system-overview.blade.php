<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="system-overview">
    <h3 class="capitalize   flex justify-between">
        <span class="border-b-2 font-extrabold">System Overview</span>
        <a href="{{ route('cache-clear') }}" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Clear Cache</a>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.system-overview') }}" method="post" class="gen-form">
                @csrf
                <input type="submit" class="hidden" id="systemSubmitButton">
                <div class="grid grid-cols-1 gap-3">
                    <h4 class="mb-2 uppercase text-orange-500 font-mono">System Environment</h4>
                    <div class="grid grid-cols-2">
                        <p>Environment</p>
                        <div class="relative w-full">
                            <span class="theme1-input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                </svg>
                            </span>
                            <select name="app_env" id="app_env" class="theme1-text-input" required
                                onChange="systemSubmitButton.click()">
                                <option value="local" @if (env('APP_ENV') === 'local') selected @endif>Local</option>
                                <option value="staging" @if (env('APP_ENV') === 'staging') selected @endif>Staging
                                </option>
                                <option value="production" @if (env('APP_ENV') === 'production') selected @endif>Production
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <p>Debug Mode</p>
                        <div class="relative w-full">
                            <span class="theme1-input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                </svg>
                            </span>
                            <select name="app_debug" id="app_debug" class="theme1-text-input" required
                                onChange="systemSubmitButton.click()">
                                <option value="false" @if (env('APP_ENV') === false) selected @endif>Disabled
                                </option>
                                <option value="true" @if (env('APP_DEBUG') === true) selected @endif>Enabled
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <p>Error Log</p>
                        <div class="relative w-full">
                            <span class="theme1-input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                </svg>
                            </span>
                            <select name="log_level" id="log_level" class="theme1-text-input" required
                                onChange="systemSubmitButton.click()">
                                <option value="debug" @if (env('LOG_LEVEL') === 'debug') selected @endif>Debug</option>
                                <option value="info" @if (env('LOG_LEVEL') === 'info') selected @endif>Info</option>
                                <option value="notice" @if (env('LOG_LEVEL') === 'notice') selected @endif>Notice</option>
                                <option value="warning" @if (env('LOG_LEVEL') === 'warning') selected @endif>Warning
                                </option>
                                <option value="error" @if (env('LOG_LEVEL') === 'error') selected @endif>Error</option>
                                <option value="critical" @if (env('LOG_LEVEL') === 'critical') selected @endif>Critical
                                </option>
                                <option value="alert" @if (env('LOG_LEVEL') === 'alert') selected @endif>Alert
                                </option>
                                <option value="emergency" @if (env('LOG_LEVEL') === 'emergency') selected @endif>Emergency
                                </option>
                            </select>
                        </div>
                    </div>

                    <h4 class="mb-2 uppercase text-orange-500 font-mono">Server Environment</h4>

                    <div class="grid grid-cols-2">
                        <p>Installed Version</p>
                        <div>
                            <p>v{{ env('APP_VERSION') }}</p>

                        </div>
                    </div>


                    <div class="grid grid-cols-2">
                        <p>PHP Version</p>
                        <div>
                            @if (strpos(PHP_VERSION, '8.1.') !== false)
                                <p class="text-green-500">v{{ PHP_VERSION }}</p>
                            @else
                                <p class="text-red-500">v{{ PHP_VERSION }}</p>
                                <p class="text-xs font-mono text-blue-500">install v8.1.x</p>
                            @endif
                        </div>
                    </div>



                    <div class="grid grid-cols-2">
                        <p>Laravel Version</p>
                        <div>
                            <p class="text-green-500">v{{ Illuminate\Foundation\Application::VERSION }}</p>

                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <p>SSL</p>
                        <div>
                            @if (strpos(url('/'), 'https://') !== false)
                                <p class="text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                    </svg>
                                </p>
                            @else
                                <p class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                </p>
                                <p class="text-xs font-mono text-blue-500">install ssl</p>
                            @endif
                        </div>
                    </div>

                    @foreach ($extensions as $extension => $status)
                        <div class="grid grid-cols-2">
                            <p>{{ $extension }}</p>
                            <div>
                                @if ($status)
                                    <p class="text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                    </p>
                                @else
                                    <p class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                    </p>
                                    <p class="text-xs font-mono text-blue-500">install {{ $extension }} php
                                        extension
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @foreach ($execution_sizes as $name => $size)
                        <div class="grid grid-cols-2">
                            <p>{{ $name }}</p>
                            <div>
                                @if ($size['status'])
                                    <p class="text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                    </p>
                                @else
                                    <p class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                    </p>
                                    <p class="text-xs font-mono text-blue-500">
                                        upgrade {{ $name }} to {{ $size['recommended'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <h4 class="mb-2 uppercase text-orange-500 font-mono">Folder Permission</h4>
                    @foreach ($file_permissions as $perm)
                        <div class="grid grid-cols-2">
                            <p>{{ $perm['folder'] }}</p>
                            <div>
                                @if ($perm['status'])
                                    <p class="text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                    </p>
                                @else
                                    <p class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                    </p>
                                    <p class="text-xs font-mono text-blue-500">
                                        requires 0775 permission
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>

        </div>


    </div>

</div>

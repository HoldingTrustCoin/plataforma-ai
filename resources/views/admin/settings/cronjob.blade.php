@php
    use App\Models\CronJob;
    $jobs = CronJob::get();
    $phpPath = exec('which php');
    $project = basename(base_path());
@endphp

<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="cronjob">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">CronJob Setting</span>
    </h3>




    <div class="w-full">
        <div class="relative grid grid-cols-1 gap-5 mt-5">
            @foreach ($jobs as $job)
                @if ($job->type == 'link')
                    <div class="w-full ts-gray-3 rounded-lg p-2">
                        <h2 class="text-lg font-bold capitalize">{{ str_replace('-', ' ', $job->name) }}</h2>
                        <p>Last Run time: <span class="@if ($job->last_run < now()->addMinutes(-10)->timestamp) text-red-500 @else text-green-500 @endif">{{ formatTimestamp($job->last_run) }}</span></p>

                        <p class="">CPanel Command</p>
                        <div class=" cursor-pointer clipboard break-all p-3 ts-gray-1 text-xs text-orange-500" data-copy="wget -q -O- {{ route($job->name) }} >/dev/null 2>&1">
                            
                            <div class="w-full flex justify-between items-center">
                                <span>wget -q -O- {{ route($job->name) }} >/dev/null 2>&1</span>
                                <span class="text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>

                                </span>
                            </div>
                        </div>
                        <div class="h-5"></div>
                        <p class="">Hpanel Command (Hostinger)</p>
                        <div class=" cursor-pointer clipboard break-all p-3 ts-gray-1 text-xs text-orange-500" data-copy="wget -O- /dev/null {{ route($job->name) }}">
                            
                            <div class="w-full flex justify-between items-center">
                                <span>wget -O- /dev/null {{ route($job->name) }} </span>
                                <span class="text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>

                                </span>
                            </div>
                        </div>
                    </div>
                @else 
                    <div class="w-full ts-gray-3 rounded-lg p-2">
                        <h2 class="text-lg font-bold capitalize">{{ str_replace('-', ' ', $job->name) }}</h2>
                        <p>Last Run time: <span class="@if ($job->last_run < now()->addMinutes(-10)->timestamp) text-red-500 @else text-green-500 @endif">{{ formatTimestamp($job->last_run) }}</span></p>

                        <p class="">CPanel Command</p>
                        <div class=" cursor-pointer clipboard break-all p-3 ts-gray-1 text-xs text-orange-500" data-copy="cd {{ $project  }} && {{ $phpPath }} artisan schedule:run >/dev/null 2>&1">
                            
                            <div class="w-full flex justify-between items-center">
                                <span>cd {{ $project  }} && {{ $phpPath }} artisan schedule:run >/dev/null 2>&1</span>
                                <span class="text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>

                                </span>
                            </div>
                        </div>
                        <div class="h-5"></div>
                        <p class="">Hpanel Command (Hostinger)</p>
                        <div class=" cursor-pointer clipboard break-all p-3 ts-gray-1 text-xs text-orange-500" data-copy="{{ $project }}/artisan schedule:run">
                            
                            <div class="w-full flex justify-between items-center">
                                <span> {{ $project }}/artisan schedule:run </span>
                                <span class="text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>

                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach




        </div>
    </div>

</div>

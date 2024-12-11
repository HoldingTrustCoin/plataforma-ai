@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-72 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    {{-- total users --}}
                    <div
                        class="w-full flex items-center  ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div class="w-full">
                                <div class="w-full mb-1 flex justify-between items-center">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>
                                    <p class=" font-bold text-gray-500">Total Users</p>
                                    <p><span
                                            class="px-2 py-1 ts-gray-3 rounded-full ">{{ number_format($user_query->count()) }}</span>
                                    </p>
                                </div>

                                <div class="w-full font-mono mt-2">

                                    <p class="w-fulll flex justify-between items-center text-xs">
                                        Email:
                                        <span class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 text-green-500"
                                                fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                <circle cx="8" cy="8" r="8" />
                                            </svg>
                                            <span>{{ number_format($user_query->whereNotNull('email_verified_at')->count()) }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 text-orange-500"
                                                fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                <circle cx="8" cy="8" r="8" />
                                            </svg>
                                            <span>{{ number_format($user_query->whereNull('email_verified_at')->count()) }}</span>
                                        </span>

                                    </p>

                                    <p class="w-fulll flex justify-between items-center text-xs">
                                        KYC:
                                        <span class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 text-green-500"
                                                fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                <circle cx="8" cy="8" r="8" />
                                            </svg>
                                            <span>{{ number_format($user_query->whereNotNull('kyc_verified_at')->count()) }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 text-orange-500"
                                                fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                <circle cx="8" cy="8" r="8" />
                                            </svg>
                                            <span>{{ number_format($user_query->whereNull('kyc_verified_at')->count()) }}</span>
                                        </span>

                                    </p>


                                </div>
                            </div>

                        </div>

                    </div>



                    {{-- balance --}}
                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Cummulative Bal.</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ formatAmount($user_query->sum('balance')) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="users">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Users</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Name, Username or Email," id="search-users-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-users-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Name
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="users">
                                        <a class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            href="{{ route('admin.users.index') }}" id="search-users-url">Search</a>
                                    </div>
                                </div>
                            </div>


                            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
                                @forelse ($users as $user)
                                    <div
                                        class="w-full  ts-gray-g3 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">

                                        <div class="w-full ts-gray-3 flex items-center justify-center relative">
                                            <div
                                                class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full">
                                                @if (site('kyc_v') == 1)
                                                    @if ($user->kyc_verified_at)
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="w-6 h-6 text-green-500" viewBox="0 0 16 16">
                                                            <path
                                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-6 h-6 text-orange-500 " fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                    @endif
                                                @elseif (site('email_v') == 1)
                                                    @if ($user->email_verified_at)
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="w-6 h-6 text-green-500" viewBox="0 0 16 16">
                                                            <path
                                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-6 h-6 text-orange-500 " fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                    @endif
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        class="w-6 h-6 text-green-500" viewBox="0 0 16 16">
                                                        <path
                                                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                    </svg>
                                                @endif
                                            </div>

                                            <div class="w-44 h-44 bg-contain bg-center bg-no-repeat mb-2"
                                                style="background-image: url({{ asset('storage/profile/' . $user->photo) }});">


                                            </div>

                                        </div>

                                        <div class="p-3">
                                            <div class="w-full flex justify-between items-center text-xs text-gray-500">
                                                <p class="text-orange-500">Name</p>
                                                <p class="uppercase font-mono font-bold px-2 py-1">
                                                    {{ $user->name ?? 'Not Set' }}</p>
                                            </div>

                                            <div class="w-full flex justify-between items-center text-xs text-gray-500">
                                                <p class="text-orange-500">Username</p>
                                                <p class="uppercase font-mono font-bold px-2 py-1">
                                                    {{ $user->username ?? 'Not Set' }}
                                                </p>
                                            </div>
                                            <div class="w-full flex justify-between items-center text-xs text-gray-500">
                                                <p class="text-orange-500">Email</p>
                                                <p class="font-mono font-bold">{{ $user->email ?? 'Not Set' }}</p>
                                            </div>


                                            <div class="w-full flex justify-between items-center text-xs text-gray-500">
                                                <p class="text-orange-500">Balance</p>
                                                <p class="uppercase font-mono font-bold px-2 py-1">
                                                    {{ formatAmount($user->balance) }}
                                                </p>
                                            </div>



                                            <div class="break-all mt-2 mb-2">


                                                <p class="flex justify-end cursor-pointer text-xs break-all">
                                                    <a href="{{ route('admin.users.view', ['id' => $user->id]) }}"
                                                        class="view-single-user flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white ts-gray-3 px-2 py-1 rounded-full text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                        <span>View</span>
                                                    </a>

                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div
                                        class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                            fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span>Empty Record. No user found!</span>
                                    </div>
                                @endforelse
                            </div>





                            <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="users">
                                {{ $users->links('paginations.simple') }}
                            </div>
                        </div>
                    </div>

                </div>



            </div>

        </div>
    </div>


@endsection


@section('scripts')
    <script>
        $(document).on('change', '#search-users-input', function(e) {
            var base_url = "{{ route('admin.users.index') }}";
            var url_query = $(this).val();
            var params = new URLSearchParams();
            params.append('s', url_query);
            var formed_url = base_url + '?' + params.toString();
            $('#search-users-url').attr('href', formed_url);
        });
    </script>
@endsection

@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3">
                <div class="w-full grid grid-cols-1 gap-3 ts-gray-2 rounded-lg p-5 mb-3">



                    {{-- balance --}}
                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Account Balance</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ formatAmount($user->balance) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Total Deposits</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ formatAmount($user->deposits_sum_amount) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Total Withdrawals</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ formatAmount($user->withdrawals_sum_amount) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Bot Activations</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ number_format($user->bot_activations_count) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Bot Capital</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ formatAmount($user->bot_activations_sum_capital) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Bot Profits</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ formatAmount($user->bot_history_sum_profit) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        class="w-full flex items-center ts-gray-2 rounded-lg p-3 border border-slate-800 hover:border-slate-600 transition-all">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <div class="mb-1">
                                    <p class=" font-bold text-gray-500">Direct Referrals</p>
                                </div>

                                <div class="flex items-center justify-between font-mono">
                                    <div class="ts-gray-3 text-purple-500 rounded-full p-2 w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            class="bi bi-people-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        </svg>
                                    </div>

                                    <span>{{ number_format($user->referrals_count) }}</span>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
            <div class="w-full lg:w-2/3">

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="single-user-view">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Profile Overview</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">


                            <div class="w-full grid grid-cols-1 gap-3">
                                <div
                                    class="w-full  ts-gray-g3 rounded-lg border border-slate-800 hover:border-slate-600 p-3">

                                    <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-3">
                                        <div class="w-full flex items-center justify-center relative">

                                            <div>
                                                <div class="w-32 h-32 bg-contain bg-center bg-no-repeat mb-2"
                                                    style="background-image: url({{ asset('storage/profile/' . $user->photo) }});">

                                                </div>
                                                <div class="text-center">
                                                    <p> {{ $user->name }} </p>
                                                    <p>{{ $user->gender }}</p>
                                                </div>

                                            </div>



                                        </div>
                                        <div>
                                            <p><span class="font-bold">Registered:</span></p>
                                            <p><span class="font-bold">Status:</span> Active</p>
                                            <p><span class="font-bold">Email:</span> verified</p>
                                            <p><span class="font-bold">KYC:</span> Verified</p>
                                        </div>
                                    </div>

                                    <div class="mt-3 grid grid-cols-1 lg:grid-cols-2 gap-5">


                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Username</p>
                                            <p class="uppercase font-mono font-bold ">
                                                {{ $user->username ?? 'Not Set' }}
                                            </p>
                                        </div>
                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Email</p>
                                            <p class="font-mono font-bold">{{ $user->email ?? 'Not Set' }}</p>
                                        </div>

                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Gender</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->gender ?? 'Not Set' }}
                                            </p>
                                        </div>


                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Address</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->address ?? 'Not Set' }}
                                            </p>
                                        </div>

                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">State</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->state ?? 'Not Set' }}
                                            </p>
                                        </div>

                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Country</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->country ?? 'Not Set' }}
                                            </p>
                                        </div>

                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Phone</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->phone ?? 'Not Set' }}
                                            </p>
                                        </div>

                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">D.o.B</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->dob ?? 'Not Set' }}
                                            </p>
                                        </div>

                                        <div
                                            class="w-full flex justify-between items-center text-xs text-gray-500 ts-gray-3 hover:text-white cursor-pointer hover:scale-110 transition-all">
                                            <p class="text-purple-500 ts-gray-1 px-2 py-1">Referred By</p>
                                            <p class="uppercase font-mono font-bold px-2 py-1">
                                                {{ $user->referred_by ?? 'Direct Signup' }}
                                            </p>
                                        </div>

                                    </div>

                                    <div
                                        class="w-full flex flex-wrap  justify-evenly md:justify-center items-center space-x-0 space-y-3 lg:space-x-5 mt-10 mb-5">

                                        <a class="user-action-trigger-button w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-gray-500 hover:bg-gray-600"
                                            role="button" data-action="status">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                            @if ($user->status == 1)
                                                <h6>Suspend</h6>
                                            @else
                                                <h6>Reactivate</h6>
                                            @endif

                                        </a>

                                        <a class="user-action-trigger-button w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-orange-500 hover:bg-orange-600"
                                            data-action="edit" role="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <h6>Edit</h6>
                                        </a>

                                        <a class="user-action-trigger-button  w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-blue-500 hover:bg-blue-600 mt-2 md:mt-0"
                                            role="button" data-action="credit-debit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                            </svg>
                                            <h6>Credit/Debit</h6>
                                        </a>

                                        <a class="user-action-trigger-button hidden  w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-purple-500 hover:bg-purple-600 mt-2 md:mt-0"
                                            role="button" data-action="send-email">
                                            <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                            <h6>Send email</h6>
                                        </a>

                                        <a class="user-action-trigger-button w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-blue-500 hover:bg-blue-600 mt-2 md:mt-0"
                                            role="button" data-action="change-password">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                            <h6>Change Password</h6>
                                        </a>

                                        <a class="user-action-trigger-button w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-purple-500 hover:bg-purple-600 mt-2 md:mt-0"
                                            data-action="login-as-user" role="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                            </svg>
                                            <h6>Login as User</h6>
                                        </a>

                                        <a class="user-action-trigger-button flex justify-center items-center px-3 py-2 rounded-lg bg-red-500 hover:bg-red-600"
                                            role="button" data-action="delete">
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <h6>Delete</h6>
                                            </div>
                                        </a>


                                    </div>
                                </div>
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
        // view a single user
        $(document).on('click', '.view-single-user', function(e) {
            e.preventDefault();

        });


        // user trigger button
        $(document).on('click', '.user-action-trigger-button', function(e) {
            e.preventDefault();
            var clicked = $(this);
            var action = clicked.data('action');

            var html = "Action Not recognized";
            if (action === 'status') {
                // var current_state =  clicked.data('current_state')
                html = `
                <div class="mt-5 h-72 ts-gray-3 p-2 rounded-lg flex justify-center items-center">
                    <form action="{{ route('admin.users.status', ['id' => $user->id]) }}" method="POST" class="gen-form" data-action="reload">
                        @csrf

                        @if ($user->status == 1)
                            <h2 class="text-white text-center">Are You sure you want to suspend this user?</h2>
                            <button class="mt-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Yes, Suspend</button>
                        @else
                            <h2 class="text-white text-center">Are You sure you want to reactivate this user?</h2>
                            <button class="mt-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Yes, Reactivate</button>
                        @endif
                    </form>
                </div>
                `;

            } else if (action === 'edit') {
                html = `
                <div class="w-full lg:w-190 p-5 mb-5 ts-gray-2 rounded-lg transition-all overflow-y-scroll">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Update Profile
                            Information</span></h3>
                    <form action="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="mt-5 gen-form" data-action="reload">
                        @csrf

                        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        person
                                    </span>
                                    <input type="text" name="name" placeholder="Name" id="name"
                                        class="theme1-text-input" {!! is_required('name', false) !!}
                                        value="{{ old('name') ?? $user->name }}">
                                    <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">Name
                                        {!! is_required('name') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        person
                                    </span>
                                    <input type="text" name="username" placeholder="Username" id="username"
                                        class="theme1-text-input" {!! is_required('username', false) !!}
                                        
                                        value="{{ old('username') ?? $user->username }}">
                                    <label for="username" class="placeholder-label text-gray-300 ts-gray-2 px-2">Username
                                        {!! is_required('username') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('username')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        mail
                                    </span>
                                    <input type="email" name="email" placeholder="Email" id="email"
                                        class="theme1-text-input" {!! is_required('email', false) !!}
                                        value="{{ old('email') ?? $user->email }}" required>
                                    <label for="email" class="placeholder-label text-gray-300 ts-gray-2 px-2">Email
                                        {!! is_required('email') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        call
                                    </span>
                                    <input type="text" name="phone" placeholder="Phone" id="phone"
                                        class="theme1-text-input" {!! is_required('phone', false) !!}
                                        value="{{ old('phone') ?? $user->phone }}">
                                    <label for="phone" class="placeholder-label text-gray-300 ts-gray-2 px-2">Phone
                                        {!! is_required('phone') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-1 gap-5 mb-2 mt-3">
                            <div class="relative">

                                <span class="theme1-input-icon material-icons">
                                    location_on
                                </span>

                                <textarea name="address" placeholder="Address" id="address" class="theme1-text-input" {!! is_required('address', false) !!}>{{ old('address') ?? $user->address }}</textarea>
                                <label for="address" class="placeholder-label text-gray-300 ts-gray-2 px-2">Address
                                    {!! is_required('address') !!}</label>
                                <span class="text-xs text-red-500">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-5 mt-3">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        location_on
                                    </span>
                                    <input type="text" name="city" placeholder="City" id="city"
                                        class="theme1-text-input" {!! is_required('city', false) !!}
                                        value="{{ old('city') ?? $user->city }}">
                                    <label for="city" class="placeholder-label text-gray-300 ts-gray-2 px-2">City
                                        {!! is_required('city') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        location_on
                                    </span>
                                    <input type="text" name="state" placeholder="State" id="state"
                                        class="theme1-text-input" {!! is_required('state', false) !!}
                                        value="{{ old('state') ?? $user->state }}">
                                    <label for="state" class="placeholder-label text-gray-300 ts-gray-2 px-2">State
                                        {!! is_required('state') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('state')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        location_on
                                    </span>
                                    <select type="country" name="country" placeholder="Country" id="country"
                                        class="theme1-text-input" {!! is_required('country', false) !!}>
                                        <option disabled @if (!old('country') || !$user->country) selected @endif>Select Country
                                        </option>
                                        @foreach (countries() as $country)
                                            <option value="{{ $country->english_name }}"
                                                @if (old('country') ?? $user->country == $country->english_name) selected @endif>
                                                {{ $country->english_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="country" class="placeholder-label text-gray-300 ts-gray-2 px-2">Country
                                        {!! is_required('country') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                        </div>

                        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-5 mt-3">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        calendar_month
                                    </span>
                                    <input type="date" name="dob" placeholder="D.O.B" id="dob"
                                        class="theme1-text-input" {!! is_required('dob', false) !!}
                                        value="{{ old('dob') ?? $user->dob }}">
                                    <label for="dob" class="placeholder-label text-gray-300 ts-gray-2 px-2">D.O.B
                                        {!! is_required('dob') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>



                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        male
                                    </span>
                                    <select name="gender" placeholder="Gender" id="gender" class="theme1-text-input"
                                        {!! is_required('gender', false) !!}>
                                        <option disabled @if (!old('gender') || !$user->gender) selected @endif>Select Gender
                                        </option>
                                        <option value="male" @if (old('gender') ?? $user->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if (old('gender') ?? $user->gender == 'female') selected @endif>Female
                                        </option>
                                        <option value="neutral" @if (old('gender') ?? $user->gender == 'neutral') selected @endif>Neutral
                                        </option>
                                    </select>
                                    <label for="gender" class="placeholder-label text-gray-300 ts-gray-2 px-2">Gender
                                        {!! is_required('gender') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                        </div>

                        <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                            <button type="submit"
                                class="bg-purple-500 px-2 py-1 rounded-full hover:text-white transition-all">Save
                                Changes </button>
                        </div>

                    </form>
                </div>
                `;
            } else if (action === 'credit-debit') {
                html = `
                <div class="w-full lg:w-190 p-5 mb-5 ts-gray-2 rounded-lg transition-all overflow-y-scroll">
                    <h3 class="capitalize  font-extrabold text-white mb-3 mt-3"><span class="border-b-2">Credit/ Debit {{ $user->username }}</span></h3>
                    <form action="{{ route('admin.users.credit-debit', ['id' => $user->id]) }}" class="mt-5 gen-form" data-action="reload">
                        @csrf

                        <div class="w-full grid grid-cols-1 gap-5">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        paid
                                    </span>
                                    <input type="number" step="any" name="amount" placeholder="Amount" id="amount"
                                        class="theme1-text-input" {!! is_required('name', false) !!}
                                        value="{{ old('amount') }}">
                                    <label for="amount" class="placeholder-label text-gray-300 ts-gray-2 px-2">Amount
                                        {!! is_required('name') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        merge_type
                                    </span>
                                    <select name="type" placeholder="Type" id="type" class="theme1-text-input"
                                        {!! is_required('name', false) !!}>
                                        <option disabled selected >Choose Action
                                        </option>
                                        <option value="credit" >Credit
                                        </option>
                                        <option value="debit" >Debit
                                        </option>
                                        
                                    </select>
                                    <label for="type" class="placeholder-label text-gray-300 ts-gray-2 px-2">Type
                                        {!! is_required('name') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        format_quote
                                    </span>
                                    <input type="text" name="description" placeholder="Description" id="description"
                                        class="theme1-text-input" {!! is_required('name', false) !!}
                                         required>
                                    <label for="email" class="placeholder-label text-gray-300 ts-gray-2 px-2">Description
                                        {!! is_required('name') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            
                        </div>
                        

                        
                        <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                            <button type="submit"
                                class="bg-purple-500 px-2 py-1 rounded-full hover:text-white transition-all">Proceed </button>
                        </div>

                    </form>
                </div>
                `;

            } else if (action === 'send-email') {
                html = `
                <div class="mt-5 h-72 ts-gray-3 p-2 rounded-lg flex justify-center items-center">
                    <div>
                        <h2 class="text-white text-center">Send Email to {{ $user->username }} ?</h2>
                        <button type="button" class="mt-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Yes,  Send</button>
                    </div>
                </div>
                `;
            } else if (action === 'change-password') {
                html = `
                <div class="w-full lg:w-190 p-5 mb-5 ts-gray-2 rounded-lg transition-all overflow-y-scroll">
                    <h3 class="capitalize  font-extrabold text-white mb-3 mt-3"><span class="border-b-2">Change {{ $user->username }}'s password</span></h3>
                    <form action="{{ route('admin.users.change-password', ['id' => $user->id]) }}" class="mt-5 gen-form" data-action="reload">
                        @csrf

                        <div class="w-full grid grid-cols-1 gap-5">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        lock
                                    </span>
                                    <input type="password"  name="password" placeholder="New Password" id="password"
                                        class="theme1-text-input" {!! is_required('name', false) !!}>
                                    <label for="password" class="placeholder-label text-gray-300 ts-gray-2 px-2">Password
                                        {!! is_required('name') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        lock
                                    </span>
                                    <input type="password"  name="password_confirmation" placeholder="Confirm Password" id="password_confirmation"
                                        class="theme1-text-input" {!! is_required('name', false) !!}>
                                    <label for="password_confirmation" class="placeholder-label text-gray-300 ts-gray-2 px-2">Confirm Password
                                        {!! is_required('name') !!}</label>
                                    <span class="text-xs text-red-500">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            
                            
                        </div>
                        

                        
                        <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                            <button type="submit"
                                class="bg-purple-500 px-2 py-1 rounded-full hover:text-white transition-all">Save Change </button>
                        </div>

                    </form>
                </div>
                `;
            } else if (action === 'login-as-user') {
                html = `
                    <div class="mt-5 h-72 ts-gray-3 p-2 rounded-lg flex justify-center items-center">
                        <div>
                            <h2 class="text-white text-center">Login as {{ $user->username }} ?</h2>
                            <form action="{{ route('admin.users.login-as-user', ['id' => $user->id]) }}" class="mt-5 gen-form" data-action="redirect" data-url="{{ route('user.dashboard') }}">
                                @csrf
                                <button type="submit" class="mt-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Yes,  Login</button>
                            </form>
                            
                        </div>
                    </div>
                `;
            } else if (action === 'delete') {
                html = `
                    <div class="mt-5 h-72 ts-gray-3 p-2 rounded-lg flex justify-center items-center">
                        <div>
                            <h2 class="text-white text-center">Delete {{ $user->username }} ?</h2>
                            <form action="{{ route('admin.users.delete', ['id' => $user->id]) }}" class="mt-5 gen-form" data-action="redirect" data-url="{{ route('admin.users.index') }}">
                                @csrf
                                <button type="submit" class="mt-5 bg-red-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Yes,  Delete</button>
                            </form>
                            
                        </div>
                    </div>
                `;
            } else {
                toastNotify('error', 'Action not recognized');
            }

            Swal.fire({
                html: html,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCloseButton: true,
                allowEscapeKey: false, // Prevent closing by escape key
                allowOutsideClick: false, // Prevent closing by clicking backdrop
                willClose: () => {
                    //delete the previously generated qrcode
                    // $('#single_wallet_qrcode').html('');
                }
            });
        });
    </script>
@endsection

@extends('layouts.user')

@section('contents')
    <div class="w-full p-3">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <div class="ts-gray-3 p-3 rounded-lg">
                        You have {{ user()->referredUsers->count() }} direct referrals
                    </div>


                    <div class="ts-gray-3 rounded-lg p-2 text-purple-500 flex items-center cursor-pointer clipboard break-all"
                        data-copy="{{ route('user.register', ['ref' => user()->username ?? 'notset']) }}">
                        {{ route('user.register', ['ref' => user()->username ?? 'notset']) }}
                        <span class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                            </svg>

                        </span>
                    </div>


                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card overflow-x-scroll">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">My Referral Tree</span>
                    </h3>

                    <div class="w-full mt-10">


                        @php
                            function displayReferralTree($user, $level = 1, $maxLevels = 10)
                            {
                                if ($level >= $maxLevels) {
                                    return;
                                }
                            
                                $referredUsers = $user->referredUsers;
                            
                                if ($referredUsers->count() > 0) {
                                    echo '<div class="w-full">';
                                    foreach ($referredUsers as $referredUser) {
                                        echo '<div class="border-l-4 border-l-blue-500 mt-3" style="margin-left:' . 40 * $level . 'px"> <span class="ts-gray-3 p-3 w-44">' . $referredUser->username . '</span></div>';
                                        displayReferralTree($referredUser, $level + 1, $maxLevels);
                                    }
                                    echo '</div>';
                                }
                            }
                        @endphp

                        <div class="w-full">
                            <div class="flex justify-start items-center">
                                <span class="border-l-4 border-l-blue-500 ts-gray-3 p-3">
                                    {{ user()->username }}
                                </span>

                            </div>

                            @php
                                displayReferralTree(user());
                            @endphp
                        </div>






                    </div>

                </div>





            </div>

        </div>
    </div>
@endsection

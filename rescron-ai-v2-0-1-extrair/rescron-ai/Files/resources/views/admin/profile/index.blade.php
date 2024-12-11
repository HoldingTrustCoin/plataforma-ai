@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3">
        <div class="w-full mb-2 lg:flex justify-between lg:space-x-3 lg:gap-3">
            <div class="w-full lg:w-2/3 ts-gray-2 rounded-lg px-3 py-10 mb-5">
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-sm font-bold">
                        Basic Information
                    </h2>
                    <a href="{{ route('admin.profile.edit') }}"
                        class="flex space-x-1 items-center hover:scale-110 transition-all bg-purple-500 rounded-full px-2 py-1 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                        <span>Update</span>
                    </a>
                </div>
                {{-- profile Picture --}}
                <div class="w-full">
                    <img class="w-32 h-32 rounded-full" src="{{ asset('storage/profile/' . admin()->photo) }}"
                        alt="{{ admin()->adminname ?? 'Profile Photo' }}">
                </div>

                {{-- account information --}}

                <div class="mt-3 w-full">
                    <div class="w-3/4 md:w-2/3 grid grid-cols-2 hover:scale-110 transition-all mb-2">
                        <div class="text-purple-500 flex items-center space-x-1 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="currentColor"
                                class="bi bi-circle-fill" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <span class="text-white font-bold ">Name</span>
                        </div>
                        <div class="text-gray-700">
                            {{ admin()->name ?? 'Not Set' }}
                        </div>
                    </div>

                    <div class="w-3/4 md:w-2/3 grid grid-cols-2 hover:scale-110 transition-all mb-2">
                        <div class="text-purple-500 flex items-center space-x-1 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="currentColor"
                                class="bi bi-circle-fill" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <span class="text-white font-bold ">Email</span>
                        </div>
                        <div class="text-gray-700">
                            {{ admin()->email ?? 'Not Set' }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="w-full lg:w-1/3">
                <div class="w-full  ts-gray-2 rounded-lg px-3 py-10 mb-5">
                    <div class="w-full flex justify-between items-center">
                        <h2 class="text-sm font-bold">
                            Additional Information
                        </h2>

                    </div>



                    <div class="mt-3 w-full">
                        <div class="w-full grid grid-cols-2 hover:scale-110 transition-all mb-2">
                            <div class="text-purple-500 flex items-center space-x-1 ">
                                <span class="text-gray-500 font-bold uppercase ">logged In Ip:</span>
                            </div>

                            <div>
                                <p>{{ request()->ip() }}</p>
                            </div>

                        </div>

                        

                        

                    </div>
                </div>

                
            </div>

        </div>
    </div>
@endsection

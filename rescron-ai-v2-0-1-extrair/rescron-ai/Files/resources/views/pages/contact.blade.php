@php
    
    $page_title = 'Contact Us';
    $short_description = 'We are available 24/7. You can reach us via any of the means below.';
    
@endphp

{{-- layout --}}
@extends('layouts.front')





@section('contents')
    {{-- breadcrumb --}}
    @include('pages.breadcrumb')

    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center">
            <div class="w-full  md:w-3/4 grid grid-cols-1">
                <div class="w-full">
                    <div class="w-full md:w-2/3 grid grid-cols-1 gap-5">
                        <div class="sm:hidden mt-10">
                            <i class="bi bi-circle-fill text-green-500"></i>
                            <i class="bi bi-circle-fill text-blue-500"></i>
                            <i class="bi bi-circle-fill text-red-500"></i>

                        </div>


                    </div>
                    <h2 class="uppercase text-orange-500 font-mono">Revolutionizing the World of Trading</h2>

                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="w-full grid grid-cols-1 gap-5 mt-10">
                            <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                                <div>
                                    <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                        src="{{ asset('assets/images/contact/1.png') }}" alt="">
                                </div>
                                <div class="">
                                    <h4 class="rescron-font-bold">
                                        Call
                                    </h4>
                                    <h4 class="text-gray-500">
                                        {{ site('phone') }}
                                    </h4>
                                </div>
                            </div>

                            <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                                <div>
                                    <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                        src="{{ asset('assets/images/contact/2.png') }}" alt="">
                                </div>
                                <div class="">
                                    <h4 class="rescron-font-bold">
                                        Email
                                    </h4>
                                    <h4 class="text-gray-500">
                                        {{ site('email') }}
                                    </h4>
                                </div>
                            </div>

                            <div class="w-full flex justify-start space-x-2 p-2 ts-gray-2 rounded-lg">
                                <div>
                                    <img class="w-16 h-16 p-1 rounded-lg bg-orange-500"
                                        src="{{ asset('assets/images/contact/3.png') }}" alt="">
                                </div>
                                <div class="">
                                    <h4 class="rescron-font-bold">
                                        Office
                                    </h4>
                                    <h4 class="text-gray-500">
                                        {{ site('address') }}, {{ site('city') }}, {{ site('state') }},
                                        {{ site('country') }}
                                    </h4>
                                </div>
                            </div>
                        </div>


                        <div class="ts-gray-2 rounded-lg p-3">
                            <form action="{{ route('contact-validate') }}" method="post" enctype="multipart/form-data"
                                class="gen-form" data-action="reset">
                                @csrf

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 gap-5 mb-2 mt-5 w-full">
                                        <div class="relative">


                                            <input type="email" placeholder="" id="email"
                                                class="theme1-text-input pl-3" name="email" required>
                                            <label for="email"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Email
                                            </label>

                                        </div>

                                        <div class="relative">


                                            <input type="text" placeholder="" id="subject"
                                                class="theme1-text-input pl-3" name="subject" required>
                                            <label for="subject"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Subject
                                            </label>

                                        </div>

                                        <div class="relative">
                                            <label for="message" class="">Message</label>

                                            <textarea name="message" id="message" class="theme1-text-input pl-3 h-32" required></textarea>


                                        </div>


                                    </div>
                                </div>



                                <div class="px-3 flex flex-start">
                                    <button type="submit"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Send
                                        Message
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>








                </div>


            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
@endpush

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/scripts/main.js') }}"></script>
@endsection

@extends('layouts.user')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Account Updated</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="currentColor"
                            class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path
                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path
                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>KYC Documents Uploaded </span>
                        @if ($kyc_records->count() > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="currentColor"
                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-500" fill="currentColor"
                                class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>
                        @endif
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>KYC Documents Verified </span>
                        @if (user()->kyc_verified_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="currentColor"
                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-500" fill="currentColor"
                                class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>
                        @endif
                    </h3>


                </div>
            </div>
            <div class="w-full lg:w-2/3">
                @if ($kyc_records->count() > 0)
                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card  transition-all">
                        <h3 class="capitalize  font-extrabold "><span class="border-b-2">My KYC Record</span>
                        </h3>
                        <div class="w-full mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                            @foreach ($kyc_records as $record)
                                <div class="ts-gray-3 rounded">
                                    <img class="w-full h-44"
                                        src="{{ asset('storage/kyc/' . json_decode($record->photos)->front) }}"
                                        alt="">
                                    <div class="w-full px-3 py-5 flex justify-between items-center">
                                        <div>
                                            <p class="font-bold capitalize font-mono">{{ $record->document_type }}</p>
                                            <p class="text-gray-500 text-xs font-semibold">
                                                {{ date('M d, Y', strtotime($record->created_at)) }}</p>
                                        </div>
                                        <div>
                                            @if ($record->status == 'approved')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500"
                                                    fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                </svg>
                                            @elseif ($record->status == 'pending')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500"
                                                    fill="currentColor" class="bi bi-patch-question-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636zM7.002 11a1 1 0 1 0 2 0 1 1 0 0 0-2 0zm1.602-2.027c.04-.534.198-.815.846-1.26.674-.475 1.05-1.09 1.05-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745.336 0 .504-.24.554-.627z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500"
                                                    fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (!user()->kyc_verified_at && $kyc_records->where('status', '!=', 'rejected')->count() < 1)
                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card  transition-all">
                        <h3 class="capitalize  font-extrabold "><span class="border-b-2">Start KYC
                                Verification</span></h3>
                        <form action="{{ route('user.kyc.upload') }}" class="mt-5 gen-form" enctype="multipart/form-data"
                            data-action="reload">
                            @csrf
                            <input type="hidden" name="document_type" id="document_type">

                            <div class="grid grid-cols-1 mb-5">
                                <div class="text-gray-500  rounded p-2 ts-gray-1 h-44 overflow-y-scroll pb-10">
                                    <h2 class="underline font-bold">KYC Disclaimer</h2>
                                    <div class="font-mono text-xs grid grid-cols-1 gap-3">
                                        <p>
                                            {{ site('name') }} fully complies with {{ site('country') }}'s and
                                            International
                                            Anti-Money Laundering and Anti-Terrorism Financing Laws . Such legislation is
                                            the
                                            applicable institutional framework on preventing and combating money laundering
                                            and
                                            terrorist financing and incorporates the provisions of Directive (EU) 2015/849,
                                            2018/843 of the European Parliament and of the Council, the Financial Action
                                            Task
                                            Force (FATF) 2012 and US BSA/AML Act.
                                        </p>

                                        <p>
                                            It is the policy of {{ site('name') }} to prohibit and actively prevent money
                                            laundering and any activity that facilitates money laundering or the funding of
                                            terrorist or criminal activities by complying with all applicable requirements
                                            under
                                            the Bank Secrecy Act (BSA) and its implementing regulations.
                                        </p>
                                        <p>
                                            Our AML policies, procedures and internal controls are designed to ensure
                                            compliance
                                            with all applicable BSA regulations and FINRA rules and will be reviewed and
                                            updated
                                            on a regular basis to ensure appropriate policies, procedures and internal
                                            controls
                                            are in place to account for both changes in regulations and changes in our
                                            business.
                                            <br>
                                            <b class="font-bold">Rules: 31 C.F.R. § 1023.210; FINRA Rule 3310.</b>
                                        </p>
                                        <p>
                                            Pursuant to the BSA and its implementing regulations, financial institutions are
                                            required to make certain searches of their records upon receiving an information
                                            request from FinCEN.
                                        </p>
                                        <p>
                                            We will respond to a Financial Crimes Enforcement Network (FinCEN) request
                                            concerning accounts and transactions (a 314(a) Request) by immediately searching
                                            our
                                            records to determine whether we maintain or have maintained any account for, or
                                            have
                                            engaged in any transaction with, each individual, entity or organization named
                                            in
                                            the 314(a)
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="currentColor"
                                    class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <h2 class="text-mono text-sm">Select your KYC Document type to proceed</h2>
                            </div>
                            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 mt-5">

                                <div data-target="national_id" data-value="national id card"
                                    class="ts-gray-3 h-20 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer type">
                                    <div class="relative type_select hidden" id="national_id">
                                        <div
                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="font-extrabold mt-6 px-2 flex item-center justify-center">
                                        National ID Card
                                    </div>
                                </div>

                                <div data-target="passport" data-value="passport"
                                    class="ts-gray-3 h-20 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer type">
                                    <div class="relative type_select hidden" id="passport">
                                        <div
                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="font-extrabold mt-6 px-2 flex item-center justify-center">
                                        Int'l Passport
                                    </div>
                                </div>

                                <div data-target="voters_card" data-value="voters card"
                                    class="ts-gray-3 h-20 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer type">
                                    <div class="relative type_select hidden" id="voters_card">
                                        <div
                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="font-extrabold mt-6 px-2 flex item-center justify-center">
                                        Voters Card
                                    </div>
                                </div>

                                <div data-target="drivers_license" data-value="drivers license"
                                    class="ts-gray-3 h-20 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer type">
                                    <div class="relative type_select hidden" id="drivers_license">
                                        <div
                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="font-extrabold mt-6 px-2 flex item-center justify-center">
                                        Drivers License
                                    </div>
                                </div>


                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                                <div class="w-full grid grid-cols-1  gap-5 mb-3 kyc-field hidden">
                                    <label for="" class="flex font-medium font-mono items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500"
                                            fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z" />
                                        </svg>
                                        <span>Front ID</span>

                                    </label>
                                    <label
                                        class="h-44 rounded font-medium flex flex-grow justify-center items-center border border-slate-800 hover:border-slate-600 cursor-pointer"
                                        for="front">
                                        <span id="front-preview"
                                            class="uploadIcon rounded w-full h-full  flex justify-center items-center border border-slate-800 hover:border-slate-600"
                                            style="background-image: url({{ asset('assets/images/front-id.png') }}); background-size: cover; background-repeat: no-repeat;">
                                            <span class="ts-gray-3 hover:bg-orange-600 border p-2 text-white rounded-full">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                            </span>
                                        </span>
                                    </label>
                                    <input class="hidden" type="file" accept="image/*" name="front" id="front"
                                        data-preview="front-preview">


                                </div>

                                <div class="w-full grid grid-cols-1  gap-5 mb-3 kyc-field hidden" id="kyc-field-back">
                                    <label for="" class="flex font-medium font-mono items-center space-x-1">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500"
                                            fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z" />
                                        </svg>
                                        <span>Back ID</span>

                                    </label>
                                    <label
                                        class="h-44 rounded font-medium flex flex-grow justify-center items-center border border-slate-800 hover:border-slate-600 cursor-pointer"
                                        for="back">
                                        <span id="back-preview"
                                            class="uploadIcon rounded w-full h-full  flex justify-center items-center border border-slate-800 hover:border-slate-600"
                                            style="background-image: url({{ asset('assets/images/back-id.png') }}); background-size: cover; background-repeat: no-repeat;">
                                            <span class="ts-gray-3 hover:bg-orange-600 border p-2 text-white rounded-full">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                            </span>
                                        </span>
                                    </label>
                                    <input class="hidden" type="file" accept="image/*" name="back" id="back"
                                        data-preview="back-preview">


                                </div>

                                <div class="w-full grid grid-cols-1  gap-5 mb-3 kyc-field hidden">
                                    <label for="" class="flex font-medium font-mono items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500"
                                            fill="currentColor" class="bi bi-3-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.082.414c.92 0 1.535.54 1.541 1.318.012.791-.615 1.36-1.588 1.354-.861-.006-1.482-.469-1.54-1.066H5.104c.047 1.177 1.05 2.144 2.754 2.144 1.653 0 2.954-.937 2.93-2.396-.023-1.278-1.031-1.846-1.734-1.916v-.07c.597-.1 1.505-.739 1.482-1.876-.03-1.177-1.043-2.074-2.637-2.062-1.675.006-2.59.984-2.625 2.12h1.248c.036-.556.557-1.054 1.348-1.054.785 0 1.348.486 1.348 1.195.006.715-.563 1.237-1.342 1.237h-.838v1.072h.879Z" />
                                        </svg>
                                        <span>Selfie</span>

                                    </label>
                                    <label
                                        class="w-48 h-60 rounded font-medium flex flex-grow justify-center items-center border border-slate-800 hover:border-slate-600 cursor-pointer"
                                        for="selfie">
                                        <span id="selfie-preview"
                                            class="uploadIcon rounded w-full h-full  flex justify-center items-center border border-slate-800 hover:border-slate-600"
                                            style="background-image: url({{ asset('assets/images/selfie.jpg') }}); background-size: cover; background-repeat: no-repeat;">
                                            <span class="ts-gray-3 hover:bg-orange-600 border p-2 text-white rounded-full">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                            </span>
                                        </span>
                                    </label>
                                    <input class="hidden" type="file" accept="image/*" name="selfie" id="selfie"
                                        data-preview="selfie-preview">


                                </div>
                            </div>


                            <div class="mt-10 mb-10 px-3 kyc-field hidden">
                                <button type="submit"
                                    class="bg-purple-500 px-2 py-1 rounded-full hover:scale-110 transition-all"> Upload
                                    Documents </button>
                            </div>

                        </form>
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', ".type", function(e) {
            $('.type_select').addClass('hidden');
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');
            var type = $(this).data('value');
            $('#document_type').val(type);
            $('.kyc-field').addClass('hidden');
            if (type === 'passport') {
                $('.kyc-field').not('#kyc-field-back')
                    .removeClass('hidden')
                    .hide()
                    .fadeIn(2000);
            } else {
                $('.kyc-field').removeClass('hidden').hide().fadeIn(2000);
            }

        });
    </script>
@endsection

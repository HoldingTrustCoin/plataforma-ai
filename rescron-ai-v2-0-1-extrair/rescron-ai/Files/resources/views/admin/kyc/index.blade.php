@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Approved</span>
                        <span class="text-green-500">{{ $kyc_summary['approved'] }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Pending</span>
                        <span class="text-orange-500">{{ $kyc_summary['pending'] }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Rejected</span>
                        <span class="text-red-500">{{ $kyc_summary['rejected'] }}</span>
                    </h3>





                </div>
            </div>
            <div class="w-full lg:w-2/3">
                @if ($kyc_records->count() > 0)
                    <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card  transition-all">
                        <h3 class="capitalize  font-extrabold "><span class="border-b-2">All KYC Records</span>
                        </h3>
                        <div class="w-full mt-5 grid grid-cols-1 md:grid-cols-2 gap-5" id="records">

                            @foreach ($kyc_records as $record)
                                <div class="ts-gray-3 rounded">
                                    <img class="w-full h-44"
                                        src="{{ asset('storage/kyc/' . json_decode($record->photos)->front) }}"
                                        alt="">
                                    <div class="w-full px-3 py-5 flex justify-between items-center">
                                        <div>
                                            <p class="font-bold capitalize font-mono flex space-x-1 items-center">
                                                <span>{{ $record->user->name }}</span>
                                                @if ($record->status == 'approved')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500"
                                                        fill="currentColor" class="bi bi-patch-check-fill"
                                                        viewBox="0 0 16 16">
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
                                            </p>
                                            <p class="text-gray-500 text-xs font-semibold">
                                                {{ date('M d, Y', strtotime($record->created_at)) }}</p>

                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-xs font-semibold mb-2">
                                                {{ $record->document_type }}</p>
                                            <p>
                                                <a href="{{ route('admin.kyc.view', ['id' => $record->id]) }}"
                                                    class="flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white ts-gray-2 px-2 py-1 rounded-full text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
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
                            @endforeach
                        </div>

                        <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination mt-5"
                            data-paginator="records">
                            {{ $kyc_records->links('paginations.simple') }}
                        </div>
                    </div>
                @endif


            </div>

        </div>
    </div>
@endsection

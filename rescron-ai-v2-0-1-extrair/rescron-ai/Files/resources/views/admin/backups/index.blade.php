@php
    //format file size
    if (!function_exists('fileSizeConvert')) {
        function fileSizeConvert($bytes)
        {
            $bytes = floatval($bytes);
            $arBytes = [
                0 => [
                    'UNIT' => 'TB',
                    'VALUE' => pow(1024, 4),
                ],
                1 => [
                    'UNIT' => 'GB',
                    'VALUE' => pow(1024, 3),
                ],
                2 => [
                    'UNIT' => 'MB',
                    'VALUE' => pow(1024, 2),
                ],
                3 => [
                    'UNIT' => 'KB',
                    'VALUE' => 1024,
                ],
                4 => [
                    'UNIT' => 'B',
                    'VALUE' => 1,
                ],
            ];

            foreach ($arBytes as $arItem) {
                if ($bytes >= $arItem['VALUE']) {
                    $result = $bytes / $arItem['VALUE'];
                    $result = str_replace('.', '.', strval(round($result, 2))) . ' ' . $arItem['UNIT'];
                    break;
                }
            }
            return $result ?? 000;
        }
    }

@endphp

@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3 hidden">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    {{-- <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Approved</span>
                        <span class="text-green-500">{{ formatAmount($summary['finished']) }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Pending</span>
                        <span class="text-orange-500">{{ formatAmount($summary['waiting']) }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Rejected</span>
                        <span class="text-red-500">{{ formatAmount($summary['expired']) }}</span>
                    </h3> --}}





                </div>
            </div>
            <div class="w-full ">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="backups">


                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5 md:p-10">
                            {{-- <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Txn Ref" id="search-deposit-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-deposit-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Txn Ref
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="deposits">
                                        <a id="search-deposit-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('admin.deposits.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div> --}}
                            <table class="datatable-skeleton-table text-[#bfc9d4] text-xs md:text-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>File</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody width="100%">
                                    @foreach ($backups as $backup)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><span
                                                    class="local-time">{{ date('d-m-y H:i:s', filemtime($backup)) }}</span>
                                            </td>
                                            <td>{{ pathinfo($backup)['basename'] }}</td>
                                            <td>{{ fileSizeConvert(filesize($backup)) }}</td>
                                            <td>
                                                <a class="flex justify-end items-center text-blue-500"
                                                    href="{{ route('admin.backups.download', ['file' => pathinfo($backup)['basename']]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        class="w-5 h-5" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
                                                        <path
                                                            d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>







                        </div>
                    </div>

                </div>





            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script>
        // search deposit
        $(document).on('input keyup', '#search-deposit-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-deposit-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-deposit-button').attr('href', link);
        });

        let interval;
        //single deposit
        $(document).on('click', '.view-single-deposit', function(e) {
            var clicked = $(this);
            clicked.addClass('relative disabled');
            clicked.append('<span class="button-spinner"></span>');
            clicked.prop('disabled', true);
            var link = $(this).data('link');
            $('#single-display-new-deposit-information').removeClass('hidden');
            var html = $('#single-display-new-deposit-information');


            $.ajax({
                url: link,
                method: 'GET',
                success: function(response) {
                    var deposit = response.deposit;

                    Swal.fire({
                        html: `
                        <div class="mt-5" id="single-display-new-deposit-information">
                            <div>
                                <div class="ts-gray-1 p-2 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                    <div class="w-full flex justify-between items-center mb-2">
                                        <div id="single_wallet_qrcode" class="clipboard" data-copy=""></div>
                                        <div class="ts-gray-3 rounded-lg p-1">
                                            <form action="" class="mt-5 gen-form" data-action="reload" id="processForm">
                                                @csrf
                                                <div class="grid grid-cols-1 mb-2">
                                                    <div class="relative">

                                                        <span class="theme1-input-icon material-icons">
                                                            merge_type
                                                        </span>
                                                        <select name="action" placeholder="Action" id="action" class="theme1-text-input"
                                                            {!! is_required('name', false) !!}>
                                                            <option disabled selected >Choose Action
                                                            </option>
                                                            <option value="approve" >Approve
                                                            </option>
                                                            <option value="reject" >Reject
                                                            </option>
                                                            <option value="delete" >Delete
                                                            </option>
                                                            
                                                        </select>
                                                        <label for="type" class="placeholder-label text-gray-300 ts-gray-2 px-2">Action
                                                            {!! is_required('name') !!}</label>
                                                        <span class="text-xs text-red-500">
                                                            @error('type')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <button type="submit" class="mt-5 mb-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Process</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="w-full text-mono text-sm break-all">
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Status </h2>
                                            <h2 class="font-bold"> <span id="single_display_deposit_status"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Valid Until </h2>
                                            <h2 class="font-bold"> <span id="single_display_deposit_valid_until"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Amount </h2>
                                            <h2 class="font-bold">{{ site('currency') }}<span id="single_display_deposit_amount"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Fee </h2>
                                            <h2 class="font-bold">{{ site('currency') }}<span id="single_display_deposit_fee"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Pay Amount</h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_converted_amount"
                                                    class="clipboard cursor-pointer" data-copy=""> </span> <span
                                                    id="single_display_deposit_currency"></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Network </h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_network"
                                                    class="clipboard cursor-pointer" data-copy=""></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Wallet Address </h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_payment_wallet"
                                                    class="clipboard cursor-pointer" data-copy=""></span>
                                            </h2>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <h2>Txn Ref </h2>
                                            <h2 class="font-bold"><span id="single_display_deposit_ref" class="clipboard cursor-pointer"
                                                    data-copy=""></span>
                                            </h2>
                                        </div>
    
                                        
    
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        `,
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


                    // Loop through the deposit object's properties
                    for (var key in deposit) {
                        if (deposit.hasOwnProperty(key)) {
                            var value = deposit[key];
                            var element = $('#single_display_deposit_' + key);
                            if (element.length > 0) {
                                element.text(value);
                            }

                            //update the copy attribute
                            if (element.hasClass('clipboard')) {
                                element.attr('data-copy', value);
                            }


                        }
                    }

                    // create qrcode
                    var qrCodeElement = document.getElementById('single_wallet_qrcode');
                    var qrCode = new QRCode(qrCodeElement, {
                        text: deposit.payment_wallet,
                        width: 128,
                        height: 128
                    });

                    var walletQrCodeDiv = document.getElementById('single_wallet_qrcode');
                    walletQrCodeDiv.setAttribute('data-copy', deposit.payment_wallet);
                    var imageElement = walletQrCodeDiv.querySelector('img');
                    imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                        'hover:border-slate-600', 'cursor-pointer', 'p-1');
                    //imageElement.setAttribute('style', '');

                    //create a count down
                    var targetId = 'single_display_deposit_valid_until';
                    var targetDateString = deposit.valid_until;
                    if (interval) {
                        clearInterval(interval);
                    }

                    interval = setInterval(function() {
                        updateCountdown(targetId, targetDateString);
                    }, 1000);

                    var processAction = "{{ url('/') }}" + '/admin/deposits/' + deposit.id + '/process';
                    $('#processForm').attr('action', processAction);
                    if (deposit.status !== "waiting" && deposit.status !== "partially_paid") {
                        $("#action option[value='approve'], #action option[value='reject']").remove();
                    }
                    


                },
                complete: function() {
                    clicked.removeClass('disabled');
                    clicked.find('.button-spinner').remove();
                    clicked.prop('disabled', false);

                }
            });


        });
    </script> --}}

    
@endsection

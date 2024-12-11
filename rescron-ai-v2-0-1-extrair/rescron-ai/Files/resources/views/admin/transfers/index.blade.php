@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="pageContent">
        <div class="w-full lg:flex lg:gap-3" id="refresh">
            <div class="w-full lg:w-1/3 h-32 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <div class="w-full ">
                        There are {{ $transfers->total() }} transfers
                    </div>

                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="transfers">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">transfer History</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="Txn Ref" id="search-transfer-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-transfer-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Txn Ref
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="transfers">
                                        <a id="search-transfer-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('admin.transfers.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            @forelse ($transfers as $transfer)
                                <div
                                    class="w-full flex justify-between items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <div class="">
                                        
                                        <p class="local-time">{{ date('d-m-y H:i:s', strtotime($transfer->created_at)) }}
                                        </p>
                                        <p class="clipboard cursor-pointer break-all" data-copy="{{ $transfer->ref }}">

                                            REF: {{ $transfer->ref }}
                                        </p>
                                        <p class="font-bold text-mono">{{ formatAmount($transfer->amount) }}</p>
                                        <p class=" break-all" data-copy="{{ $transfer->ref }}">

                                            Fee: {{ formatAmount($transfer->fee) }}
                                        </p>

                                    </div>
                                    <div class="break-all">
                                        <span class="flex justify-end items-center space-x-1">
                                            <span class="text-red-500">From:</span>
                                            <span>{{ $transfer->sender_name }}</span>
                                        </span>

                                        <span class="flex justify-end items-center space-x-1">
                                            <span class="text-green-500">To:</span>
                                            <span>{{ $transfer->receiver_name }}</span>
                                        </span>
                                        <p class="flex justify-end mt-3">
                                            <a role="button"
                                                data-url="{{ route('admin.transfers.delete', ['id' => $transfer->id]) }}"
                                                class="delete-transfer flex items-center space-x-1 bg-red-500 px-2 py-1 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                                <span>Delete</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                            @empty
                                <div
                                    class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <span>Empty Record. No transfer found!</span>
                                </div>
                            @endforelse





                            <div class="w-full flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                                data-paginator="transfers">
                                {{ $transfers->links('paginations.simple') }}
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
        // search transfer
        $(document).on('input keyup', '#search-transfer-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-transfer-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-transfer-button').attr('href', link);
        });
    </script>

    <script>
        $(document).on('click', '.delete-transfer', function(e) {
            var clicked = $(this);
            var url = clicked.data('url');
            Swal.fire({
                html: `
                <div class="mt-5">
                    <div>
                        <div class="ts-gray-1 text-white px-2 py-5 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                            <form action="" method="post" id="deletetransferForm" class="gen-form" data-action="reload">
                                @csrf
                                
                                <p class="mb-3">Do you really want to delete this transfer?</p>

                                

                                <div class="mt-10 mb-10 px-3 flex justify-center">
                                    <button type="submit" id="activateButton"
                                        class="bg-red-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Yes Delete!
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            `,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCancelButton: false,
                showCloseButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,



            });

            $('#deletetransferForm').attr('action', url);
        });
    </script>
@endsection

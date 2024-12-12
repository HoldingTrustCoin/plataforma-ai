@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 ts-gray-2 rounded-lg p-5 mb-3">

                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span>Current Status</span>
                        @if ($record->status == 'pending')
                            <span class="text-orange-500">{{ $record->status }}</span>
                        @elseif ($record->status == 'approved')
                            <span class="text-green-500">{{ $record->status }}</span>
                        @else
                            <span class="text-red-500">{{ $record->status }}</span>
                        @endif
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">Name</span>
                        <span>{{ $record->user->name }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">username</span>
                        <span>{{ $record->user->username }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">Email</span>
                        <span>{{ $record->user->email }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">Phone</span>
                        <span>{{ $record->user->phone }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">Date Of Birth</span>
                        <span>{{ date('d-m-Y', strtotime($record->user->dob)) }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">Address</span>
                        <span>{{ $record->user->address ?? 'Not Set' }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">City</span>
                        <span>{{ $record->user->city ?? 'Not Set' }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">State</span>
                        <span>{{ $record->user->state ?? 'Not Set' }}</span>
                    </h3>

                    <h3 class="border-l-4 border-orange-500 px-3 cursor-pointer flex justify-between items-center">
                        <span class="text-xs text-gray-500">Country</span>
                        <span>{{ $record->user->country ?? 'Not Set' }}</span>
                    </h3>

                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card  transition-all">
                    <div class="w-full flex justify-between items-center">
                        <h3 class="capitalize  font-extrabold "><span class="border-b-2">KYC Records Details</span>
                        </h3>
                        <p>
                            <a role="button"
                                class="flex space-x-1 items-center text-gray-300  hover:scale-110 transition-all hover:text-white bg-orange-500 px-2 py-1 rounded-full text-xs"
                                id="proces-button">

                                <span>Process</span>
                            </a>
                        </p>
                    </div>

                    <div class="w-full mt-5 grid grid-cols-2 gap-2 ts-gray-3 rounded-lg p-3">
                        <p class="text-gray-500 text-xs">Date Registered</p>
                        <p>{{ date('d-m-Y', strtotime($record->user->created_at)) }}</p>

                        <p class="text-gray-500 text-xs">Date Uploaded</p>
                        <p>{{ date('d-m-Y', strtotime($record->created_at)) }}</p>

                        <p class="text-gray-500 text-xs">Document Type</p>
                        <p>{{ $record->document_type }}</p>
                    </div>
                    <div class="w-full mt-5 grid grid-cols-1 md:grid-cols-2 gap-5 text-gray-500 uppercase font-bold">
                        <div>
                            <p>Front ID:</p>
                            <img class="w-full h-44"
                                src="{{ asset('storage/kyc/' . json_decode($record->photos)->front) }}" alt="">
                        </div>
                        @if (json_decode($record->photos)->back)
                            <div>
                                <p>Back ID:</p>
                                <img class="w-full h-44"
                                    src="{{ asset('storage/kyc/' . json_decode($record->photos)->back) }}" alt="">
                            </div>
                        @endif

                        <div>
                            <p>Selfie:</p>
                            <img class="" src="{{ asset('storage/kyc/' . json_decode($record->photos)->selfie) }}"
                                alt="">
                        </div>

                    </div>


                </div>


            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#proces-button', function(e) {
            var html = `
                <div class="mt-5 h-72 ts-gray-3 p-2 rounded-lg flex justify-center items-center">
                    <div>
                        <h2 class="text-white text-center">Process KYC</h2>
                        <form action="{{ route('admin.kyc.process', ['id' => $record->id]) }}" class="mt-5 gen-form" data-action="reload">
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

                            <button type="submit" class="mt-5 bg-purple-500 text-white px-2 py-1 rounded-full text-xs hover:scale-110 transition-all uppercase" type="submit">Process</button>
                        </form>
                        
                    </div>
                </div>
            `;


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

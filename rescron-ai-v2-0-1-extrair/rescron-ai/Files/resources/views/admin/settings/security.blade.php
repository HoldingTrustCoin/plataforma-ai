@php
    $fields = ['name', 'username', 'address',  'state', 'country', 'gender', 'phone', 'dob'];
    $required_fields = json_decode(site('user_fields'));
@endphp


<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="security">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Security Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.security') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">


                    <div class="relative grid grid-cols-1 gap-5">

                        <div class="relative">


                            <select name="strong_password" id="strong_password" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('strong_password') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('strong_password') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="strong_password" class="placeholder-label text-gray-300 ts-gray-2 px-2">Strong Password</label>
                            
                        </div>

                        <div class="relative">


                            <select name="email_v" id="email_v" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('email_v') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('email_v') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="email_v" class="placeholder-label text-gray-300 ts-gray-2 px-2">Email Verification</label>
                            
                        </div>

                        <div class="relative">


                            <select name="kyc_v" id="kyc_v" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('kyc_v') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('kyc_v') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="kyc_v" class="placeholder-label text-gray-300 ts-gray-2 px-2">KYC Verification</label>
                            
                        </div>

                        <div class="relative">


                            <select name="user_otp" id="user_otp" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('user_otp') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('user_otp') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="user_otp" class="placeholder-label text-gray-300 ts-gray-2 px-2">User OTP</label>
                            
                        </div>

                        <div class="relative">


                            <select name="admin_otp" id="admin_otp" class="theme1-text-input pl-3" required>
                                <option value="0" @if (site('admin_otp') == 0) selected @endif> Disabled
                                </option>
                                <option value="1" @if (site('admin_otp') == 1) selected @endif> Enabled
                                </option>
                            </select>
                            <label for="admin_otp" class="placeholder-label text-gray-300 ts-gray-2 px-2">Admin OTP</label>
                            
                        </div>


                    </div>


                    <div class="mt-5">

                        <p class="font-bold font-mono text-orange-500">Required Account Fields</p>
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5  px-3 py-10"
                            id="required-fields">

                            @foreach ($fields as $key => $field)
                                <div data-target="{{ 'field_' . $key }}" 
                                    class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer required-field"
                                    data-label="{{ 'field_label' . $key }}">
                                    <div class="relative @if (!in_array($field, $required_fields)) hidden @endif"
                                        id="{{ 'field_' . $key }}">
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
                                    <div class="p-5">
                                        
                                        <div class="px-2 flex item-center justify-center">
                                            <div class="font-extrabold flex items-center space-x-1">
                                                
                                                <span>{{ strtoupper($field) }}</span>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            @endforeach




                        </div>





                    </div>



                </div>

                <div class="text-blue-500 hidden">
                    @foreach ($fields as $key => $field)
                        <div>
                            <input type="checkbox" value="{{ $field }}" name="fields[]"
                                id="{{ 'field_check_' . $key }}"
                                @if (in_array($field, $required_fields)) checked @endif>
                            <label for="{{ 'field_check_' . $key }}" id="{{ 'field_label' . $key }}">{{ $field }}</label>
                        </div>
                    @endforeach
                </div>





                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                    <button type="submit" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                        Changes </button>
                </div>

            </form>

        </div>


    </div>

</div>


@push('scripts')
    <script>
        // select the withdrawal coin
        $(document).on('click', ".required-field", function(e) {
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');
            var label = '#' + $(this).data('label');
            $(label).click();

        });
    </script>
@endpush

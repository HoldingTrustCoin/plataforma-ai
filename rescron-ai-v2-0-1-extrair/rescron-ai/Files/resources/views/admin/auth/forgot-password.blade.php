@extends('layouts.auth')

@section('contents')
    <form action="{{ route('admin.forgot-password.send') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6"
        id="registerForm">
        @csrf
        <div class="grid grid-cols-1">
            <div class="relative">
                <span class="theme1-input-icon material-icons">
                    mail
                </span>
                <input type="email" id="email" name="email" placeholder="Email" class="theme1-text-input" required>
                <label for="email" class="placeholder-label text-gray-300  ts-gray-2 px-2">Email</label>
                <span>
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>





        <div class="grid grid-cols-1 mt-3">
            <button type="submit" id="registerBtn"
                class="bg-blue-500 text-gray-300 text-xs font-semibold py-2 rounded ">Send</button>
        </div>

        <div class="flex justify-between text-gray-300 text-xs font-semibold mt-4 px-5 lg:px-10">
            <div>
                <a href="{{ route('admin.login') }}" class="hover:text-purple-700">Back to login</a>
            </div>


        </div>
    </form>


    {{-- verification form --}}

    <form action="{{ route('admin.forgot-password.validate') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6 hidden"
        id="verifyForm">
        @csrf

        <div class="grid grid-cols-1">
            <div class="relative">

                <span class="theme1-input-icon material-icons">
                    lock
                </span>
                <input type="number" name="otp" placeholder="OTP" id="otp" class="theme1-text-input" required
                    maxlength="6">
                <label for="otp" class="placeholder-label text-gray-300 ts-gray-2 px-2">OTP</label>
                <span>
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1">
            <div class="relative">

                <span class="theme1-input-icon material-icons ">
                    lock
                </span>
                <input type="password" name="password" placeholder="Password" id="password" class="theme1-text-input"
                    required>
                <label for="password" class="placeholder-label text-gray-300 ts-gray-2 px-2">Password</label>
                <span>
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>


        <div class="grid grid-cols-1">
            <div class="relative">

                <span class="theme1-input-icon material-icons ">
                    lock
                </span>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" id="confirm-password"
                    class="theme1-text-input" required>
                <label for="confirm-password" class="placeholder-label text-gray-300 ts-gray-2 px-2">Confirm
                    Password</label>
                <span>
                    @error('password-confirmation')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 mt-3">
            <button type="submit" id="verifyBtn"
                class="bg-blue-500 text-gray-300 text-xs font-semibold py-2 rounded ">Save</button>
        </div>

        <div class="flex justify-between text-gray-300 text-xs font-semibold mt-4 px-5 lg:px-10">
            <div>
                <a href="{{ route('admin.login') }}" class="hover:text-purple-700">Go Back</a>
            </div>


        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#registerForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                var form = $(this);
                var formData = form.serialize(); // Serialize form data as JSON

                var clicked = $('#registerBtn');

                //disable the submit button
                clicked.addClass('relative disabled');
                clicked.append('<span class="button-spinner"></span>');
                clicked.prop('disabled', true);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var verifyText = response.message;
                        var verify = response.verify;
                        $('#noticeMsg').html(verifyText).show();
                        toastNotify('success', verifyText);

                        //hide register form and display verification form
                        $('#registerForm').hide();
                        $('#verifyForm').show();

                        //update page title
                        $('#page-title').html('Set New Password');




                    },
                    error: function(xhr, status, error) {
                        $('#registerBtn').show();
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });


                                toastNotify('error', fieldErrors);
                            });
                        } else {
                            toastNotify('error', 'An error occured, please try again later');

                        }


                    },
                    complete: function() {
                        clicked.removeClass('disabled');
                        clicked.find('.button-spinner').remove();
                        clicked.prop('disabled', false);

                    }

                });
            });


            //otp form
            $('#verifyForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                var form = $(this);
                var formData = form.serialize(); // Serialize form data as JSON

                var clicked = $('#verifyBtn');

                //disable the submit button
                clicked.addClass('relative disabled');
                clicked.append('<span class="button-spinner"></span>');
                clicked.prop('disabled', true);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var verifyText = response.message;
                        $('#noticeMsg').html(verifyText).show();
                        toastNotify('success', verifyText);
                        var url = "{{ route('admin.login') }}";
                        window.location.href = url;

                    },
                    error: function(xhr, status, error) {
                        $('#registerBtn').show();
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });

                                toastNotify('error', fieldErrors);

                            });
                        } else {
                            toastNotify('error', 'An error occured, please try again later');

                        }


                    },

                    complete: function() {
                        clicked.removeClass('disabled');
                        clicked.find('.button-spinner').remove();
                        clicked.prop('disabled', false);

                    }

                });
            });
        });
    </script>
@endsection

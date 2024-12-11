@extends('layouts.auth')

@section('contents')
    <form action="{{ route('user.login-validate') }}" method="POST"
        class="px-4 lg:px-10 mt-6 space-y-6 @if (user()) hidden @endif" id="loginForm">
        @csrf
        <div class="grid grid-cols-1">
            <div class="relative">
                <span class="theme1-input-icon material-icons">
                    person
                </span>
                <input type="text" id="email" name="email" placeholder="Email Or Username" class="theme1-text-input"
                    required @if(env('DEMO_MODE')) value="user@user.com" @endif>
                <label for="email" class="placeholder-label text-gray-300  ts-gray-2 px-2">Email or Username</label>
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
                    required @if(env('DEMO_MODE')) value="password" @endif>
                <label for="password" class="placeholder-label text-gray-300 ts-gray-2 px-2">Password</label>
                <span>
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>



        <div class="grid grid-cols-1 mt-3">
            <button type="submit" id="loginBtn"
                class="bg-blue-500 text-gray-300 text-xs font-semibold py-2 rounded ">Login</button>
        </div>

        <div class="flex justify-between text-gray-300 text-xs font-semibold mt-4 px-5 lg:px-10">
            <div>
                <a href="{{ route('user.register') }}" class="hover:text-purple-700">Don't have account? Register</a>
            </div>

            <div>
                <a href="{{ route('user.forgot-password.index') }}" class="hover:text-purple-700">Forgot Password?</a>
            </div>


        </div>
    </form>


    {{-- verification form --}}

    <form action="{{ route('user.login-verify') }}" method="POST"
        class="px-4 lg:px-10 mt-6 space-y-6 @if (!user()) hidden @endif" id="verifyForm">
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
                    @error('otp')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 mt-3">
            <button type="submit" id="verifyBtn"
                class="bg-blue-500 text-gray-300 text-xs font-semibold py-2 rounded ">Verify</button>
        </div>

        <div class="flex justify-between text-gray-300 text-xs font-semibold mt-4 px-5 lg:px-10">
            <div>
                <button type="button" class="hover:text-purple-700" id="resendBtn">Resend OTP</button>
            </div>


        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();
                var clicked = $('#loginBtn');

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

                        if (verify == 1) {
                            //hide register form and display verification form
                            $('#loginForm').hide();
                            $('#verifyForm').show();

                            //update page title
                            $('#page-title').html('Verify OTP');
                        } else {
                            var url = '{{ route('user.dashboard') }}';
                            window.location.href = url;
                        }




                    },
                    error: function(xhr, status, error) {
                        $('#loginBtn').show();
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });


                                Swal.fire({
                                    icon: 'error',
                                    html: fieldErrors,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal.stopTimer);
                                        toast.addEventListener('mouseleave',
                                            Swal.resumeTimer);
                                    }
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'An error occured, please try again later',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter',
                                        Swal.stopTimer);
                                    toast.addEventListener('mouseleave',
                                        Swal.resumeTimer);
                                }
                            });
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
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();
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
                        var url = '{{ route('user.dashboard') }}';
                        window.location.href = url;

                    },
                    error: function(xhr, status, error) {
                        $('#verifyBtn').show();
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });


                                Swal.fire({
                                    icon: 'error',
                                    html: fieldErrors,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal.stopTimer);
                                        toast.addEventListener('mouseleave',
                                            Swal.resumeTimer);
                                    }
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'An error occured, please try again later',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter',
                                        Swal.stopTimer);
                                    toast.addEventListener('mouseleave',
                                        Swal.resumeTimer);
                                }
                            });
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


    <script>
        const resendBtn = document.getElementById('resendBtn');
        const loginBtn = document.getElementById('loginBtn');
        let isClickable = true;
        let countdown;

        function startCountdown() {
            if (isClickable) {
                isClickable = false;
                resendBtn.disabled = true;

                let secondsLeft = 120; // 2 minutes
                countdown = setInterval(() => {
                    if (secondsLeft > 0) {
                        const minutes = Math.floor(secondsLeft / 60);
                        const seconds = secondsLeft % 60;
                        const formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                        resendBtn.textContent = `Resend Again in ${formattedTime}`;
                        secondsLeft--;
                    } else {
                        resendBtn.textContent = 'Resend OTP';
                        resendBtn.disabled = false;
                        isClickable = true;
                        clearInterval(countdown);
                    }
                }, 1000); // Update every 1 second
            }
        }

        resendBtn.addEventListener('click', () => {
            startCountdown();
            // Define the CSRF token
            var csrfToken = '{{ csrf_token() }}';

            // Add the CSRF token to the request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send the AJAX request
            $.ajax({
                url: "{{ route('user.resend-otp') }}",
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    var verifyText = response.message;
                    Swal.fire({
                        icon: 'success',
                        text: verifyText,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter',
                                Swal.stopTimer);
                            toast.addEventListener('mouseleave',
                                Swal.resumeTimer);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;

                    if (errors) {
                        $.each(errors, function(field, messages) {
                            var fieldErrors = '';
                            $.each(messages, function(index, message) {
                                fieldErrors += message + '<br>';
                            });

                            Swal.fire({
                                icon: 'error',
                                html: fieldErrors,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer);
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer);
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'An error occurred, please try again later',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                    }
                }
            });




        });

        loginBtn.addEventListener('click', () => {
            startCountdown();
        });
    </script>
@endsection

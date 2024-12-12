@extends('layouts.auth')

@section('contents')
    


    {{-- verification form --}}

    <form action="{{ route('user.g2fa.g2fa') }}" method="POST"
        class="px-4 lg:px-10 mt-6 space-y-6" id="verifyForm">
        @csrf

        <div class="grid grid-cols-1">
            <div class="relative">

                <span class="theme1-input-icon material-icons">
                    lock
                </span>
                <input type="number" name="otp" placeholder="G2FA" id="otp" class="theme1-text-input" required
                    maxlength="6">
                <label for="otp" class="placeholder-label text-gray-300 ts-gray-2 px-2">G2FA</label>
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

    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            

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
                        var url = "{{ route('user.dashboard') }}";
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


@endsection

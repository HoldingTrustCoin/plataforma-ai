@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">


        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-2/3 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">

                    @if ($should_update)
                        <p>Your system is outdated. You currently have <span
                                class="text-red-500">v{{ $current_version }}</span> installed. Update to <span class="text-green-500">v{{ $latest_version }}</span></p>

                        <p class="text-xs ts-gray-1 rounded-lg p-3 font-mono hidden" id="updatelog">
                            <span>Initializing update...</span>
                        </p>
                        <div class="ts-gray-1 rounded-lg p-3 font-mono" id="changeLog">
                            <p class="font-bold text-orange-500">v{{ $latest_version }} -
                                {{ date('d/m/Y', $update['date']) }}</p>
                            @foreach ($update['logs'] as $log)
                                <p class="text-xs">-{{ $log }}</p>
                            @endforeach
                        </div>
                        {{-- check update --}}
                        <form action="{{ route('admin.settings.update.check-update') }}" method="POST"
                            class="mt-5 update-form" data-next="#downloadUpdateButton" enctype="multipart/form-data">
                            @csrf

                            <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                                <button id="checkUpdateButton" type="submit"
                                    class="updateButton bg-purple-500 px-2 py-1 rounded-full transition-all">Update to
                                    v{{ $latest_version }}</button>
                            </div>

                        </form>

                        {{-- check update --}}
                        <form action="{{ route('admin.settings.update.download-update') }}" method="POST"
                            class="update-form" data-next="#extractUpdateButton" enctype="multipart/form-data">
                            @csrf

                            <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                                <button id="downloadUpdateButton" type="submit"
                                    class="updateButton bg-purple-500 px-2 py-1 rounded-full transition-all hidden">Download
                                    v{{ $latest_version }}</button>
                            </div>

                        </form>

                        {{-- check update --}}
                        <form action="{{ route('admin.settings.update.extract-update') }}" method="POST"
                            class="update-form" data-next="#postUpdateButton" enctype="multipart/form-data">
                            @csrf

                            <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                                <button id="extractUpdateButton" type="submit"
                                    class="updateButton bg-purple-500 px-2 py-1 rounded-full transition-all hidden">Extract
                                    v{{ $latest_version }}</button>
                            </div>

                        </form>


                        {{-- post update --}}
                        <form action="{{ route('admin.settings.update.post-update') }}" method="POST"
                            class="update-form" data-next="reload" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $latest_version }}" name="latest_version">
                            <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                                <button id="postUpdateButton" type="submit"
                                    class="updateButton bg-purple-500 px-2 py-1 rounded-full transition-all hidden">Complete
                                    v{{ $latest_version }}</button>
                            </div>

                        </form>
                    @else
                        <p>Your system is updated. You currently have <span
                                class="text-green-500">v{{ $current_version }}</span> installed</p>

                        <div class="ts-gray-1 rounded-lg p-3 font-mono">
                            <p class="font-bold text-orange-500">v{{ $latest_version }} -
                                {{ date('d/m/Y', $update['date']) }}</p>
                            @foreach ($update['logs'] as $log)
                                <p class="text-xs">-{{ $log }}</p>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
            <div class="w-full lg:w-2/3">
                {{-- getting started --}}


            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // submit general form
        $(document).on('submit', '.update-form', function(e) {
            e.preventDefault();
            $("#updatelog").removeClass('hidden');
            $("#changeLog").addClass('hidden');
            var form = $(this);
            var successNext = $(this).data('next');
            var formData = new FormData(this);
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.addClass('relative disabled');
            submitButton.append('<span class="button-spinner"></span>');
            submitButton.prop('disabled', true);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    var message = response.message;

                    $("#updatelog").append('<br><br><span class="text-green-500">' + message +
                        '</span>');
                    if (successNext === 'reload') {
                        $.ajax({
                            url: window.location.href,
                            method: 'GET',
                            success: function(response) {
                                $('#refresh').html($(response).find('#refresh').html());
                                var scrollTo = $('#refresh').offset().top - 100;
                                $('html, body').animate({
                                    scrollTop: scrollTo
                                }, 800);
                            },
                            error: function() {
                                console.error('Error fetching new content');
                            }
                        });
                    } else {
                        $('.updateButton').addClass('hidden');
                        $(successNext).removeClass('hidden');
                        $(successNext).click();
                    }


                },
                error: function(xhr, status, error) {
                    submitButton.removeClass('disabled');
                    submitButton.find('.button-spinner').remove();
                    submitButton.prop('disabled', false);
                    console.log(error);
                    if (status == 422) {
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });

                                $("#updatelog").append(
                                    '<br><br><span class="text-red-500">' +
                                    fieldErrors + '</span>');
                                // toastNotify('error', fieldErrors);
                            });
                        } else {
                            $("#updatelog").append('<br><br><span class="text-red-500">' +
                                "An Error occured, try again later" + '</span>');
                            // toastNotify('error', 'An Error occured, try again later');
                        }

                    } else {
                        $("#updatelog").append('<br><br><span class="text-red-500">' + status +
                            ' Error occured, try again later' + '</span>');
                        // toastNotify('error', status +  ' Error occured, try again later');
                    }


                }
            });
        });
    </script>
@endsection

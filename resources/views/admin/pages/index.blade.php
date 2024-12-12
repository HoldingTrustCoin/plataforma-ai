@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">


        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-72 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">




                    <a data-target="pages" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        All Pages</a>



                    <a data-target="new-page" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        New Page</a>







                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="pages">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">All Pages</span>
                    </h3>

                    <div class="w-full">
                        <div class="grid grid-cols-1 gap-3 mt-5">
                            <div class="flex justify-end mb-5">
                                <div class="flex justify-end items-center  mb-2 mt-5">
                                    <div class="relative">

                                        <span class="theme1-input-icon material-icons">
                                            search
                                        </span>
                                        <input type="text" placeholder="title" id="search-pages-input"
                                            class="theme1-text-input rounded-0" value="{{ request()->s }}">
                                        <label for="search-pages-input"
                                            class="placeholder-label text-gray-300 ts-gray-2 px-2">Title
                                        </label>

                                    </div>
                                    <div class="simple-pagination" data-paginator="pages">
                                        <a id="search-pages-button"
                                            class="paginator-link px-3 py-2 bg-purple-500 hover:scale-110 transition-all"
                                            data-link="{{ route('admin.pages.index') }}" href="">Search</a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full border-b border-slate-800 hover:border-slate-600"></div>
                            @forelse ($pages as $page)
                                <div
                                    class="w-full border-b border-slate-800 hover:border-slate-600">
                                    <div class="rounded-lg">

                                        <div class="p-2">
                                            <div class="w-full flex justify-between space-x-2 items-center mb-2">
                                                <p class="flex space-x-1 items-center font-mono font-semibold">
                                                    {{ $page->title }}


                                                </p>
                                                <p class="flex space-x-2 items-center">
                                                    <a role="button" href="{{ route('page', ['slug' => $page->slug]) }}" target="_blank"
                                                        class="cursor-pointer flex items-center bg-blue-500 px-2 py rounded-lg hover:scale-110 transition-all ">View</a>

                                                    <a role="button" href="{{ route('admin.pages.edit', ['id' => $page->id]) }}"
                                                        data-url="{{ route('admin.pages.edit', ['id' => $page->id]) }}"
                                                        class="edit-page cursor-pointer flex items-center bg-purple-500 px-2 py rounded-lg hover:scale-110 transition-all ">Edit</a>

                                                    <a role="button"
                                                        data-url="{{ route('admin.pages.delete', ['id' => $page->id]) }}"
                                                        class="delete-page cursor-pointer flex items-center bg-red-500 px-2 py rounded-lg hover:scale-110 transition-all ">Delete</a>
                                                </p>

                                            </div>

                                        </div>
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
                                    <span>You have not created any pages yet</span>
                                </div>
                            @endforelse






                        </div>

                        <div class="w-full mt-5 flex items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer simple-pagination"
                            data-paginator="pages">
                            {{ $pages->links('paginations.simple') }}
                        </div>

                    </div>

                </div>




                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="new-page">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Create Page</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">

                            <form action="{{ route('admin.pages.create') }}" method="post" enctype="multipart/form-data"
                                class="gen-form" data-action="reload">
                                @csrf

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 gap-5 mb-2 mt-5 w-full">
                                        <div class="relative">


                                            <input type="text" placeholder="" id="title"
                                                class="theme1-text-input pl-3" name="title" required>
                                            <label for="name"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Title
                                            </label>

                                        </div>

                                        <div class="relative">
                                            <label for="seo" class="">SEO Description</label>

                                            <textarea name="seo" id="seo" class="theme1-text-input pl-3 h-32" required></textarea>


                                        </div>

                                        <div class="relative">
                                            <label for="content" class="">Content</label>

                                            <textarea name="content" id="content" class="theme1-text-input pl-3 h-32"></textarea>


                                        </div>
                                    </div>
                                </div>



                                <div class="mt-10 mb-10 px-3 flex flex-start">
                                    <button type="submit"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Save
                                    </button>
                                </div>


                            </form>






                        </div>



                    </div>

                </div>





            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- ck editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{-- search --}}
    <script>
        // search deposit
        $(document).on('input keyup', '#search-pages-input', function(e) {
            var title = $(this).val();
            var base_link = $('#search-pages-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-pages-button').attr('href', link);
        });
    </script>



    {{-- delete bot --}}
    <script>
        $(document).on('click', '.delete-page', function(e) {
            var clicked = $(this);
            var url = clicked.data('url');
            Swal.fire({
                html: `
                    <div class="mt-5">
                        <div>
                            <div class="ts-gray-1 text-white px-2 py-5 w-full rounded-lg border border-slate-800 hover:border-slate-600">
                                <form action="" method="post" id="deletePageForm" class="gen-form" data-action="reload">
                                    @csrf
                                    
                                    <p class="mb-3">Do you really want to delete this page?</p>

                                    

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

            $('#deletePageForm').attr('action', url);
        });
    </script>
@endsection

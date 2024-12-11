@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3" id="refresh">


        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-72 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">




                    <a data-target="pages" href="{{ route('admin.pages.index') }}"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer">
                        All Pages</a>


                </div>
            </div>
            <div class="w-full lg:w-2/3">
                



                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="edit-page">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Edit Page</span>
                    </h3>

                    <div class="w-full">


                        <div class="grid grid-cols-1 gap-3 mt-5">

                            <form action="{{ route('admin.pages.edit-validate', ['id' => $page->id ]) }}" method="post" enctype="multipart/form-data"
                                class="gen-form" data-action="none">
                                @csrf

                                <div class="flex justify-end mb-5">
                                    <div class="grid grid-cols-1 gap-5 mb-2 mt-5 w-full">
                                        <div class="relative">


                                            <input type="text" placeholder="" id="title"
                                                class="theme1-text-input pl-3" name="title" required value="{{ $page->title }}">
                                            <label for="name"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Title
                                            </label>

                                        </div>

                                        <div class="relative">
                                            <label for="seo" class="">SEO Description</label>

                                            <textarea name="seo" id="seo" class="theme1-text-input pl-3 h-32" required>{{ $page->seo }}</textarea>


                                        </div>

                                        <div class="relative">
                                            <label for="content" class="">Content</label>

                                            <textarea name="content" id="content" class="theme1-text-input pl-3 h-32">{!! json_decode($page->content) !!}</textarea>


                                        </div>
                                    </div>
                                </div>



                                <div class="mt-10 mb-10 px-3 flex flex-start">
                                    <button type="submit"
                                        class="bg-purple-500 px-2 py-1 rounded-lg hover:scale-110 transition-all"> Save Changes
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


@endsection

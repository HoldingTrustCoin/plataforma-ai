@php
   
    
    $page_title = $page->title;
    $short_description =  $page->seo;
    
@endphp

{{-- layout --}}
@extends('layouts.front')





@section('contents')
    {{-- breadcrumb --}}
    @include('pages.breadcrumb')

    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center">
            <div class="w-full flex items-center justify-center text-gray-500">
                <div class="w-full lg:w-3/4 grid grid-cols-1 gap-5 mt-10">
                    {!! json_decode($page->content) !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

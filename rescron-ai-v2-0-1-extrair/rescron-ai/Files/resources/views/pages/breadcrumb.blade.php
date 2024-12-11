<section class="w-full relative">
    <div class="h-12"></div>
    <div class="w-full flex flex-start items-center space-x-2 px-5 md:px-20 py-5 ts-gray-3">
        <div class="flex items-center justify-start space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
            </svg>
            <a href="{{ url('/') }}">Home</a>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3 h-3" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd"
                d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <p class="text-gray-500">{{ $page_title }}</p>
        
    </div>
    <div class="w-full ts-gray-2 text-center">
        <div class="h-10"></div>
        <div class="w-full px-5 md:px-20 py-5 flex justify-center items-center">
            <div class="w-full md:w-3/4">
                <div class="w-full">
                    <h1 class="text-6xl font-rescron-bold">{{ $page_title }}</h1>
                    <p class="text-gray-500 text-2xl rescron-font-italics mt-5">{{ $short_description }}</p>
                </div>

                
            </div>

        </div>
        <div class="h-44"></div>
        
    </div>
    <div class="w-full -mt-12 md:-mt-32">
        <div class="w-full flex justify-center ">
            <div class="w-3/4 ">
                <img class="rounded-lg" src="{{ asset('assets/images/breadcrumb.png') }}" alt="">
            </div>
        </div>
    </div>

    <div class="h-24"></div>
    
</section>

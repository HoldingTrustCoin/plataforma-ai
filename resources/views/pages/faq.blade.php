@php
    use App\Models\Bot;
    
    $page_title = 'FAQ';
    $short_description = 'Below are some frequently asked questions from our users';
    $faqs = [
        [
            'question' => 'What is '. site('name') .'?',
            'answer' => site('name') . ' is an advanced trading platform that utilizes AI technology to analyze market trends and execute trades with high precision.',
        ],
        [
            'question' => 'How can I get started with ' . site('name') .'?',
            'answer' => 'Getting started is simple. Sign up for an account, complete the verification process, and you can begin trading.',
        ],
        [
            'question' => 'Is my personal information secure with ' . site('name') .'?',
            'answer' => 'Yes, we take data security seriously. We employ industry-standard measures to protect your information.',
        ],
        [
            'question' => 'Can I trade on '. site('name') . 'from anywhere?',
            'answer' => 'Absolutely ' .site('name') . 'allows you to trade from anywhere with an internet connection.',
        ],
        
        [
            'question' => 'Do I need prior trading experience to use' . site('name') .'?',
            'answer' => 'No, '. site('name') . 'is designed for both beginners and experienced traders. We offer educational resources to help you get started.',
        ],
        [
            'question' => 'What fees are associated with using ' .site('name') . '?',
            'answer' => 'We charge competitive fees, which are transparently displayed on our platform. There are no hidden charges.',
        ],
        [
            'question' => 'Can I withdraw my profits easily?',
            'answer' => 'Yes, withdrawing your profits is straightforward. You can initiate withdrawals through your account.',
        ],
        [
            'question' => 'Is customer support available?',
            'answer' => 'Absolutely. Our customer support team is here to assist you with any questions or issues you may have.',
        ],
        [
            'question' => 'How often are trading signals generated?',
            'answer' =>  site('name') . ' generates trading signals continuously, ensuring you have access to up-to-date market information.',
        ],
    ];
    
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
                    @foreach ($faqs as $faq)
                        <div class="w-full ts-gray-3 p-3 rounded-lg">
                            <h3 class="w-full text-2xl rescron-font-bold">
                                {{ $faq['question'] }}
                            </h3>
                            <p class="w-full">
                                {{ $faq['answer'] }}
                            </p>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

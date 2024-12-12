@php


$page_title = 'Live AI trading';
$short_description = 'Watch live trading done by our trading bot as the execute these trades'

@endphp

{{-- layout --}}
@extends('layouts.front')





@section('contents')
    {{-- breadcrumb --}}
    @include('pages.breadcrumb')

    <section>
        <div class="w-full px-5 md:px-20 py-5 ">
            <div class="w-full flex justify-center ts-gray-2 rounded-lg p-5">
                <div class="w-full" id="recentTradesContainer">
                    <div class="w-full grid grid-cols-1 gap-3 mt-2 text-xs" id="recentTrades">
                        @foreach (recentTradesAll() as $data)
                            <div
                                class="recent-trade w-full ts-gray-3 rounded-lg p-2 grid grid-cols-4 lg:grid-cols-7 @if ($data['type'] == 1) text-green-500 @else text-red-500 @endif">
                                <p class="recent_trade_time"></p>
                                <p>{{ $data['country'] }}</p>
                                <p>{{ $data['exchange'] }}</p>
                                <p>{{ $data['bot'] }}</p>
                                <p>{{ $data['pair'] }}</p>
                                <p>{{ $data['amount'] }}</p>
                                <p>{{ $data['profit'] }}</p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {{-- schuffle recent trades --}}
    <script>
        function updateTradeTimes() {
            const tradeTimeElements = document.querySelectorAll('.recent_trade_time');
            const currentTime = new Date().toLocaleTimeString();

            tradeTimeElements.forEach((element) => {
                element.textContent = currentTime;
            });
        }

        function shuffleAndDisplayRecentTrades() {
            const tradesDiv = document.getElementById('recentTrades');
            const trades = Array.from(tradesDiv.children);

            trades.sort(() => Math.random() - 0.5); // Shuffle the array

            // Remove the existing trade divs
            while (tradesDiv.firstChild) {
                tradesDiv.removeChild(tradesDiv.firstChild);
            }

            // Append the first 10 shuffled trade divs back to the container
            for (let i = 0; i < 100 && i < trades.length; i++) {
                tradesDiv.appendChild(trades[i]);
            }

            updateTradeTimes(); // Update trade times after shuffling
        }

        // Initial shuffle and display
        shuffleAndDisplayRecentTrades();

        // Set interval to shuffle and update times every second (1000 milliseconds)
        setInterval(shuffleAndDisplayRecentTrades, 1000);

        // update every 5 minutes
        function updateRecentTrades() {
            // Use jQuery to make an AJAX request to the server
            $.ajax({
                url: window.location.href,
                method: 'GET',
                dataType: 'html',
                success: function(response) {
                    // Update the content of the recentTradesContainer div
                    var targetDiv = '#recentTradesContainer';
                    $(targetDiv).html($(response).find(targetDiv).html());
                    updateTradeTimes();
                    $('#deposits').html($(response).find('#deposits').html());

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        setInterval(updateRecentTrades, 10000);
    </script>
@endsection


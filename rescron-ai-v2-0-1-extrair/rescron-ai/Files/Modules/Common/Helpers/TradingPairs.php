<?php

use App\Models\Bot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

function tradingPairs()
{
    // Define a unique cache key for this request
    $cacheKey = 'tradingPairsData';

    // Attempt to retrieve the data from the cache
    $cachedData = Cache::get($cacheKey);

    if ($cachedData) {
        // If cached data exists, return it
        return $cachedData;
    }

    $baseUrls = [
        'https://api.binance.us',
        'https://api.binance.com',
    ];

    $tickerData = null;

    foreach ($baseUrls as $baseUrl) {
        try {
            $response = Http::get($baseUrl . '/api/v3/ticker/24hr');
            $response->throw(); // This will throw an exception if the response status is not successful

            $tickerData = $response->json();
            break; // Stop the loop if successful
        } catch (\Exception $e) {
            // Log or handle the error if needed
            continue; // Try the next URL
        }
    }

    // Filter and sort pairs based on quote volume
    $usdtPairs = collect($tickerData)
        ->filter(function ($pair) {
            return str_ends_with($pair['symbol'], 'USDT');
        })
        ->sortByDesc('priceChangePercent')
        ->take(20);

    // Cache the data for 10 minutes
    if ($tickerData) {
        Cache::put($cacheKey, $usdtPairs, now()->addMinutes(10));
    }

    return $usdtPairs;
}



function recentTrades()
{
    $usdtPairs = tradingPairs();
    $tradeData = [];
    foreach ($usdtPairs as $pair) {
        $types = [0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1];
        $types_total = count($types) - 1;
        $type = $types[rand(0, $types_total)];
        if ($type == 1) {
            $amount = site('currency_symbol') . number_format((rand(200, 10000) + (1 / rand(3, 9))), 2);

            $profit = '+' . number_format((rand(1.2, 5.3) + (1 / rand(3, 9))), 2) . '%';
        } else {
            $amount = site('currency_symbol') . number_format((rand(90, 500) + (1 / rand(3, 9))), 2);
            $profit = '-' . number_format((rand(0.9, 2.5) + (1 / rand(3, 9))), 2) . '%';
        }

        $data = [
            'pair' => $pair['symbol'],
            'type' => $type,
            'amount' => $amount,
            'profit' => $profit,
        ];

        array_push($tradeData, $data);
    }

    return $tradeData;
}


function recentTradesAll()
{
    $usdtPairs = tradingPairs();
    $tradeData = [];
    $types = [0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1];
    $types_total = count($types) - 1;

    $countries = countries();
    $exchanges = [
        'Binance',
        'Kucoin',
        'OKX',
        'Huobi'
    ];

    $bots = Bot::get();
    $bots_array = [];
    foreach($bots as $bot) {
        array_push($bots_array, $bot->name);
    }

    if (count($bots_array) <= 2) {
        array_push($bots_array, 'PY-GT5');
        array_push($bots_array, '0X-UT-H');
        array_push($bots_array, 'GO-59-YI');
    }

    foreach ($usdtPairs as $pair) {

        $type = $types[rand(0, $types_total)];
        if ($type == 1) {
            $amount = site('currency_symbol') . number_format((rand(200, 10000) + (1 / rand(3, 9))), 2);

            $profit = '+' . number_format((rand(1.2, 5.3) + (1 / rand(3, 9))), 2) . '%';
        } else {
            $amount = site('currency_symbol') . number_format((rand(90, 500) + (1 / rand(3, 9))), 2);
            $profit = '-' . number_format((rand(0.9, 2.5) + (1 / rand(3, 9))), 2) . '%';
        }

        $data = [
            'pair' => $pair['symbol'],
            'type' => $type,
            'amount' => $amount,
            'profit' => $profit,
            'country' => $countries[rand(0, 149)]->english_name,
            'bot' => $bots_array[rand(0, (count($bots_array) - 1))],
            'exchange' => $exchanges[rand(0, (count($exchanges) - 1))],
        ];

        array_push($tradeData, $data);
    }

    foreach ($usdtPairs as $pair) {

        $type = $types[rand(0, $types_total)];
        if ($type == 1) {
            $amount = site('currency_symbol') . number_format((rand(200, 10000) + (1 / rand(3, 9))), 2);

            $profit = '+' . number_format((rand(1.2, 5.3) + (1 / rand(3, 9))), 2) . '%';
        } else {
            $amount = site('currency_symbol') . number_format((rand(90, 500) + (1 / rand(3, 9))), 2);
            $profit = '-' . number_format((rand(0.9, 2.5) + (1 / rand(3, 9))), 2) . '%';
        }

        $data = [
            'pair' => $pair['symbol'],
            'type' => $type,
            'amount' => $amount,
            'profit' => $profit,
            'country' => $countries[rand(0, 149)]->english_name,
            'bot' => $bots_array[rand(0, (count($bots_array) - 1))],
            'exchange' => $exchanges[rand(0, (count($exchanges) - 1))],
        ];

        array_push($tradeData, $data);
    }

    foreach ($usdtPairs as $pair) {

        $type = $types[rand(0, $types_total)];
        if ($type == 1) {
            $amount = site('currency_symbol') . number_format((rand(200, 10000) + (1 / rand(3, 9))), 2);

            $profit = '+' . number_format((rand(1.2, 5.3) + (1 / rand(3, 9))), 2) . '%';
        } else {
            $amount = site('currency_symbol') . number_format((rand(90, 500) + (1 / rand(3, 9))), 2);
            $profit = '-' . number_format((rand(0.9, 2.5) + (1 / rand(3, 9))), 2) . '%';
        }

        $data = [
            'pair' => $pair['symbol'],
            'type' => $type,
            'amount' => $amount,
            'profit' => $profit,
            'country' => $countries[rand(0, 149)]->english_name,
            'bot' => $bots_array[rand(0, (count($bots_array) - 1))],
            'exchange' => $exchanges[rand(0, (count($exchanges) - 1))],
        ];

        array_push($tradeData, $data);
    }

    

    return $tradeData;
}

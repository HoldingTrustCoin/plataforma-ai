<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\BotActivation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BotController extends Controller
{
    //index of all bots
    public function index()
    {
        $page_title = 'My AI Bots';

        $bots = Bot::where('status', 1)->get();
        $activations =  user()
            ->botActivations()
            ->with('bot')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));

        if (request()->bot) {
            $histories = user()
                ->botHistory()
                ->with(['botActivation.bot'])
                ->whereHas('botActivation.bot', function ($query) {
                    $query->where('name', 'LIKE', '%' . request()->bot . '%');
                })
                ->orderBy('timestamp', 'DESC')
                ->paginate(site('pagination'));
        } else {
            $histories = user()
                ->botHistory()
                ->with(['botActivation.bot'])
                ->orderBy('timestamp', 'DESC')
                ->paginate(site('pagination'));
        }

        $startDate = Carbon::now()->subDays(29);
        // $startDate = Carbon::now()->subDays(59);
        $endDate = Carbon::now();

        $chart_data = user()
            ->botHistory()
            ->selectRaw('DATE(created_at) as date, SUM(profit) as total_profit, SUM(profit_percent) as total_profit_percent')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $graph_info = [];
        $days = [];
        $profits = [];

        $daily_data = [];
        $days_day = [];
        $profits_day = [];

        // Create an associative array with all days within the date range and initial values of 0
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $formatted_date = $currentDate->format('d-m');
            $graph_info[$formatted_date] = 0;

            $formatted_date_day = $currentDate->format('d-m-Y');
            $daily_data[$formatted_date_day] = ['profit' => 0, 'profit_percent' =>0 ];

            $currentDate->addDay();
            array_push($days, $formatted_date);
            array_push($days_day, $formatted_date_day);
        }

        // Populate the graph_info array with actual data from $chart_data
        foreach ($chart_data as $data) {
            $formatted_date = date('d-m', strtotime($data->date));
            $graph_info[$formatted_date] = $data->total_profit;

            $formatted_date_day = date('d-m-Y', strtotime($data->date));
            $daily_data[$formatted_date_day] = ['profit' => $data->total_profit, 'profit_percent' => $data->total_profit_percent];
            
        }

        

        uksort($daily_data, 'compareDatesDesc');

        foreach($graph_info as $day => $profit) {
            array_push($days, $day);
            array_push($profits, $profit);
        }
    





        return view('user.bots.index', compact(
            'page_title',
            'bots',
            'activations',
            'histories',
            'days',
            'profits',
            'daily_data'
        ));
    }

    //activate bot
    public function activateBot(Request $request)
    {
        $request->validate([
            'bot_id' => 'required',
            'capital' => 'required|numeric',
        ]);

        $capital = $request->capital;

        //check if the user has sufficient balance
        if (user()->balance < $capital) {
            return response()->json(validationError('Insufficient balance!'), 422);
        }

        $capital = floatval($capital);
        if ($capital <= 0) {
            return response()->json(validationError('Invalid balance!'), 422);
        }

        //retrieve the bot
        $bot = Bot::where('id', $request->bot_id)->first();

        if (!$bot) {
            return response()->json(validationError('Error accessing bot'), 422);
        }

        //check for min and max capital
        if ($capital < $bot->min || $capital > $bot->max) {
            return response()->json(validationError('Portfolio range for capital is ' . site('currency') . $bot->min . ' - ' . site('currency') . $bot->max), 422);
        }

        //debit the user 
        $user = User::where('id', user()->id)->first();

        $debit = User::find($user->id);
        $debit->balance = $user->balance - $capital;
        $debit->save();

        //log transaction
        recordNewTransaction($capital, $user->id, 'debit', "Bot [$bot->name] activation");



        // $trade_data = tradeData($bot);
        $duration = strtotime("+ $bot->duration $bot->duration_type");
        //calculate total return 
        $days = floor($duration / (60 * 60 * 24));
        //log activation
        $activation = new BotActivation();
        $activation->user_id = $user->id;
        $activation->balance = $capital;
        $activation->bot_id = $bot->id;
        $activation->capital = $capital;
        $activation->profit = 0;
        $activation->expires_in = $duration;
        $activation->daily_timestamp = now()->addDays(-1)->timestamp;
        $activation->daily_sequence = json_encode([]);
        $activation->gen_timestamps = json_encode([]);
        $activation->status = 'active';
        $activation->save();

        //notify by email
        sendNewBotActivationMail($activation);

        return response()->json(['message' => 'Bot Activated Successfully']);
    }
}

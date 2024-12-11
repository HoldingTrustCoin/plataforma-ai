<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\BotActivation;
use App\Models\BotHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BotController extends Controller
{
    //index of all bots
    public function index()
    {

        $page_title = 'AI Bots';

        $bots = Bot::get();
        $activations =  BotActivation::with('bot')
            ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));
        $histories =  BotHistory::with(['botActivation.user', 'botActivation.bot'])
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));



        $startDate = Carbon::now()->subDays(29);
        $endDate = Carbon::now();

        $chart_data = BotHistory::selectRaw('DATE(created_at) as date, SUM(profit) as total_profit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $graph_info = [];
        $days = [];
        $profits = [];

        // Create an associative array with all days within the date range and initial values of 0
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $formatted_date = $currentDate->format('d-m');
            $graph_info[$formatted_date] = 0;
            $currentDate->addDay();
            array_push($days, $formatted_date);
        }

        // Populate the graph_info array with actual data from $chart_data
        foreach ($chart_data as $data) {
            $formatted_date = date('d-m', strtotime($data->date));
            $graph_info[$formatted_date] = $data->total_profit;
        }

        foreach ($graph_info as $day => $profit) {
            array_push($days, $day);
            array_push($profits, $profit);
        }





        return view('admin.bots.index', compact(
            'page_title',
            'bots',
            'activations',
            'histories',
            'days',
            'profits'
        ));
    }

    // create a new bot
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'daily_min' => 'required|numeric',
            'daily_max' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:50000',
        ]);

        $image = $request->file('logo');
        $path = 'bots';
        $logo = uploadImage($image, $path);
        $bot = new Bot();
        $bot->name = $request->name;
        $bot->daily_min = $request->daily_min;
        $bot->daily_max = $request->daily_max;
        $bot->min = $request->min;
        $bot->max = $request->max;
        $bot->duration = $request->duration;
        $bot->duration_type = $request->duration_type;
        $bot->logo = $logo;
        $bot->status = 1;
        $bot->save();

        return response()->json(['message' => 'Bot saved successfully']);
    }


    // Edit bot
    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'daily_min' => 'required|numeric',
            'daily_max' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required',
            'logo' => 'image|mimes:png,jpg,jpeg|max:50000',
            'status' => 'required|numeric'
        ]);

        $bot = Bot::find($request->route('id'));
        if (!$bot) {
            return response()->json(validationError('Bot not found'), 422);
        }

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $path = 'bots';
            $logo = uploadImage($image, $path);
        } else {
            $logo = $bot->logo;
        }

        $bot->name = $request->name;
        $bot->daily_min = $request->daily_min;
        $bot->daily_max = $request->daily_max;
        $bot->min = $request->min;
        $bot->max = $request->max;
        $bot->status = $request->status;
        $bot->duration = $request->duration;
        $bot->duration_type = $request->duration_type;
        $bot->logo = $logo;
        $bot->save();

        return response()->json(['message' => 'Bot updated successfully successfully']);
    }


    // delete a bot
    public function deleteBot(Request $request)
    {
        $id = $request->route('id');
        $bot = Bot::find($id);
        if (!$bot) {
            return response()->json(validationError('Bot not found'), 422);
        }

        $bot->delete();

        return response()->json(['message' => $bot->name . ' has been deleted succesfully']);
    }


    // manage bot activation
    public function manageActivation(Request $request)
    {
        $request->validate([
            'action' => 'required'
        ]);

        $action  = $request->action;
        $bot = BotActivation::find($request->route('id'));
        if (!$bot) {
            return response()->json(validationError('Bot activation instead not found'), 422);
        }

        $message = 'Action not valid';
        if ($action == 'delete') {
            $bot->delete();
            $mesage = 'Bot activation has been deleted successfully';
        } elseif ($action == 'reactivate') {
            $bot->status = 'active';
            $bot->save();
            $message = 'Bot reactivated succesfully';
        } elseif ($action == 'suspend') {
            $bot->status = 'suspended';
            $bot->save();
            $message = 'Bot suspended succesfully';
        }

        return response()->json(['message' => $message]);
    }


    // delete history
    public function deleteHistory(Request $request)
    {
        $history = BotHistory::find($request->route('id'));
        if (!$history) {
            return response()->json(validationError('Trading history not found'), 422);
        }

        $history->delete();
        return response()->json(['message' => 'Trading History deleted']);
    }
}

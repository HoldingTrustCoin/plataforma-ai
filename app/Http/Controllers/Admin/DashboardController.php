<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BotActivation;
use App\Models\BotHistory;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $page_title = 'Admin Dashboard';

        $today_start = Carbon::today(); // Start of today
        $today_end = Carbon::now(); // Current time

        $yesterday_start = Carbon::yesterday(); // Start of yesterday
        $yesterday_end = Carbon::yesterday()->endOfDay(); // End of yesterday

        // Today's deposits
        $todays_deposits = Deposit::whereBetween('created_at', [$today_start, $today_end])
            ->where('status', 'finished')
            ->sum('amount');

        // Yesterday's deposits
        $yesterdays_deposits = Deposit::whereBetween('created_at', [$yesterday_start, $yesterday_end])
            ->where('status', 'finished')
            ->sum('amount');

        if ($yesterdays_deposits > 0) {
            $percentage_deposit_increase = (($todays_deposits - $yesterdays_deposits) / $yesterdays_deposits) * 100;
        } else {
            // Handle the case where yesterday's deposits are zero
            if ($todays_deposits > 0) {
                $percentage_deposit_increase = 100; // Treat as 100% increase
            } else {
                $percentage_deposit_increase = 0; // No increase since both are zero
            }
        }


        // PNL
        $activations = BotActivation::orderBy('id', 'DESC')->get();
        $capital = $activations->sum('capital');
        $profit_fig = $activations->sum('profit');
        //dd($profit / $capital);

        $activations =  BotActivation::with('bot')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));


        // history
        $histories = BotHistory::with(['botActivation.bot'])
            ->orderBy('timestamp', 'DESC')
            ->paginate(site('pagination'));

        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();

        $pnl_data = BotHistory::selectRaw('DATE(created_at) as date, SUM(profit) as total_profit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $deposit_data = Deposit::selectRaw('DATE(created_at) as date, SUM(amount) as total_deposit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $withdrawal_data = Withdrawal::selectRaw('DATE(created_at) as date, SUM(amount) as total_withdrawal')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $graph_info = [];
        $chart = [
            'days' => [],
            'deposits' => [],
            'withdrawals' => [],
            'profits'=> []
        ];

        // Create an associative array with all days within the date range and initial values of 0
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $formatted_date = $currentDate->format('d-m');
            $graph_info[$formatted_date] = [
                'profit_c' => 0,
                'deposit_c' => 0,
                'withdrawal_c' => 0,
            ];
            $currentDate->addDay();
        }

        

        // Populate the graph_info array with actual data from $pnl_data, $deposit_data and $withdrawal_data
        foreach ($pnl_data as $data) {
            $formatted_date = date('d-m', strtotime($data->date));
            if (isset($graph_info[$formatted_date])) {
                $graph_info[$formatted_date]['profit_c'] = $data->total_profit;
            }
        }

        foreach ($deposit_data as $data) {
            $formatted_date = date('d-m', strtotime($data->date));
            if (isset($graph_info[$formatted_date])) {
                $graph_info[$formatted_date]['deposit_c'] = $data->total_deposit;
            }
        }

        foreach ($withdrawal_data as $data) {
            $formatted_date = date('d-m', strtotime($data->date));
            if (isset($graph_info[$formatted_date])) {
                $graph_info[$formatted_date]['withdrawal_c'] = $data->total_withdrawal;
            }
        }



        foreach ($graph_info as $day => $data) {
            array_push($chart['days'],  $day);
            array_push($chart['profits'],  $data['profit_c']);
            array_push($chart['deposits'], $data['deposit_c']);
            array_push($chart['withdrawals'], $data['withdrawal_c']);
        }


        $withdrawals = Withdrawal::with('depositCoin')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));

        $deposits = Deposit::with('depositCoin')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));

        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.dashboard', compact(
            'page_title',
            'todays_deposits',
            'percentage_deposit_increase',
            'capital',
            'profit_fig',
            'activations',
            'histories',
            'chart',
            'withdrawals',
            'deposits',
            'users'
        ));
    }
}

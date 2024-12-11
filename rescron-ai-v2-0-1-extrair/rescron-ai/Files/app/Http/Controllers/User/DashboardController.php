<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $page_title = 'Dashboard';

        $today_start = Carbon::today(); // Start of today
        $today_end = Carbon::now(); // Current time

        $yesterday_start = Carbon::yesterday(); // Start of yesterday
        $yesterday_end = Carbon::yesterday()->endOfDay(); // End of yesterday

        // Today's deposits
        $todays_deposits = user()->transactions()
            ->whereBetween('created_at', [$today_start, $today_end])
            ->where('type', 'credit')
            ->sum('amount');

        // Yesterday's deposits
        $yesterdays_deposits = user()->transactions()
            ->whereBetween('created_at', [$yesterday_start, $yesterday_end])
            ->where('type', 'credit')
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
        $activations = user()->botActivations();
        $capital = $activations->sum('capital');
        $profit_fig = $activations->sum('profit');
        $profit_percent = user()->botHistory()->sum('profit_percent');
        //dd($profit / $capital);

        $activations =  user()
            ->botActivations()
            ->with('bot')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));


        // history
        $histories = user()
            ->botHistory()
            ->with(['botActivation.bot'])
            ->orderBy('timestamp', 'DESC')
            ->paginate(site('pagination'));

        $startDate = Carbon::now()->subDays(6);
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
        $profit_percentages = [];
        $profits = [];

        // Create an associative array with all days within the date range and initial values of 0
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $formatted_date = $currentDate->format('d-m');
            $graph_info[$formatted_date] = ['profit' => 0, 'profit_percent' => 0];
            $currentDate->addDay();
            array_push($days, $formatted_date);
        }

        // Populate the graph_info array with actual data from $chart_data
        foreach ($chart_data as $data) {
            $formatted_date = date('d-m', strtotime($data->date));
            $graph_info[$formatted_date] = ['profit' => $data->total_profit, 'profit_percent' => $data->total_profit_percent];
        }


        foreach ($graph_info as $day => $profit) {
            array_push($days, $day);
            array_push($profits, $profit['profit']);
            array_push($profit_percentages, $profit['profit_percent']);
        }

        $withdrawals = user()
            ->withdrawals()
            ->with('depositCoin')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));

        $deposits = user()
            ->deposits()
            ->with('depositCoin')
            ->orderBy('id', 'DESC')
            ->paginate(site('pagination'));
            
        return view('user.dashboard', compact(
            'page_title',
            'todays_deposits',
            'percentage_deposit_increase',
            'capital',
            'profit_fig',
            'activations',
            'histories',
            'profits',
            'days',
            'profit_percentages',
            'withdrawals',
            'deposits',
            'profit_percent'
        ));
    }
}

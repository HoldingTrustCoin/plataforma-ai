<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositCoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class SettingController extends Controller
{
    // index
    public function index()
    {
        // dd(Cache::forget('site'));

        $page_title = 'Settings';
        $file_permissions  = [
            checkFolderPermission('bootstrap/cache'),
            checkFolderPermission('storage'),
            checkFolderPermission('storage/app'),
            checkFolderPermission('storage/framework'),
            checkFolderPermission('storage/logs'),
            checkFolderPermission('storage/debugbar'),
        ];


        $extensions = [
            'bcmath' => extension_loaded('bcmath'),
            'ctype' => extension_loaded('ctype'),
            'curl' => extension_loaded('curl'),
            'fileinfo' => extension_loaded('fileinfo'),
            'gd' => extension_loaded('gd'),
            'gmp' => extension_loaded('gmp'),
            'json' => extension_loaded('json'),
            'mbstring' => extension_loaded('mbstring'),
            'openssl' => extension_loaded('openssl'),
            'pdo' => extension_loaded('pdo'),
            'pdo_mysql' => extension_loaded('pdo_mysql'),
            'tokenizer' => extension_loaded('tokenizer'),
            'xml' => extension_loaded('xml'),
            'zip' => extension_loaded('zip'),
            'ionCubeLoader' => extension_loaded('ionCube Loader'),
        ];

        function asBytes($ini_v)
        {
            $ini_v = trim($ini_v);
            $s = ['g' => 1 << 30, 'm' => 1 << 20, 'k' => 1 << 10];
            return intval($ini_v) * ($s[strtolower(substr($ini_v, -1))] ?: 1);
        }

        $max_allowed_packet = DB::select('SELECT @@global.max_allowed_packet limit 1');
        $max_allowed_packet = collect($max_allowed_packet[0]);
        $packet = '';
        foreach ($max_allowed_packet as $pack) {
            $packet .= $pack;
        }

        $packet = floor($packet / 1e+6) . 'M';

        $execution_sizes = [
            'post_max_size' => [
                'recommended' => '750M',
                'current' => ini_get("post_max_size"),
                'status' => (asBytes(ini_get("post_max_size")) >= asBytes('750M'))
            ],
            'upload_max_filesize' => [
                'recommended' => '750M',
                'current' => ini_get("upload_max_filesize"),
                'status' => (asBytes(ini_get("upload_max_filesize")) >= asBytes('750M'))
            ],
            'max_execution_time' => [
                'recommended' => 5000,
                'current' => ini_get("max_execution_time"),
                'status' => (ini_get("max_execution_time") >= 5000)
            ],
            'max_input_time' => [
                'recommended' => 5000,
                'current' => ini_get("max_input_time"),
                'status' => (ini_get("max_input_time") >= 5000)
            ],

            'memory_limit' => [
                'recommended' => '1000M',
                'current' => ini_get("memory_limit"),
                'status' => (asBytes(ini_get("memory_limit")) >= asBytes('1000M')),
            ],

            'max_allowed_packet' => [
                'recommended' => '200M',
                'current' => $packet,
                'status' => (asBytes($packet) >= asBytes('200M')),
            ],
        ];

        $deposit_coins = DepositCoin::orderBy('status', 'DESC')->get();
        $withdrawal_coins = DepositCoin::orderBy('can_withdraw', 'DESC')->get();

        $url = "https://ipinfo.io/ip";
        $ips = [$_SERVER['SERVER_ADDR']];
        if (!Str::contains(domain(), '.local')) {
            $resp = Http::get($url);
            if ($resp->successful()) {
                $ip = $resp->body();

                $ips = [$ip, $_SERVER['SERVER_ADDR']];
            }
        }

        // some servers use IPV6,
        $api_key = "4A3H094-9Q2M302-Q4KEYP6-K00D452"; //dummy api to retrieve ip from failed balance;
        // Verify that there is sufficient balance to cover the withdrawal
        $response = Http::withHeaders([
            'x-api-key' => $api_key,
        ])->get('https://api.nowpayments.io/v1/balance');

        // Check if the request was successful
        if (!$response->successful()) {
            $resp = json_decode($response->body());
            $message = $resp->message;
            if (Str::contains($message, 'IP')) {
                $ip = str_replace('Access denied | Invalid IP -', '', $message);
                $ip = str_replace(' ', '', $ip);
                array_push($ips, $ip);
            }
        }



        return view('admin.settings.index', compact(
            'page_title',
            'extensions',
            'execution_sizes',
            'file_permissions',
            'deposit_coins',
            'withdrawal_coins',
            'ips'
        ));
    }


    public function systemOverview(Request $request)
    {
        $request->validate([
            'app_env' => 'required',
            'app_debug' => 'required',
            'log_level' => 'required'
        ]);

        updateEnvValue('APP_ENV', $request->app_env);
        updateEnvValue('APP_DEBUG', $request->app_debug);
        updateEnvValue('LOG_LEVEL', $request->log_level);

        return response()->json(['message' => 'System environment updated']);
    }

    // update core
    public function core(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'currency_position' => 'required',
            'use_sign' => 'required|numeric',
            'logo_square' => 'image|mimes:png,jpg,jpeg|max:50000',
            'logo_rec' => 'image|mimes:png,jpg,jpeg|max:50000',
            'favicon' => 'image|mimes:png,jpg,jpeg|max:50000',
        ]);

        $path = 'assets/images/';
        $logo_square = site('logo_square');
        $logo_rec = site('logo_rec');
        $favicon = site('favicon');
        if ($request->hasFile('logo_square')) {
            $file = $request->file('logo_square');
            $file_name = 'logo-square.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $file_name);
            $logo_square = $file_name . '?v=' . time();
        }

        if ($request->hasFile('logo_rec')) {
            $file = $request->file('logo_rec');
            $file_name = 'logo-rec.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $file_name);
            $logo_rec = $file_name . '?v=' . time();
        }

        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $file_name = 'favicon.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $file_name);
            $favicon = $file_name . '?v=' . time();
        }

        $settings = [
            'name' => $request->name,
            'currency' => $request->currency,
            'currency_symbol' => $request->currency_symbol,
            'currency_position' => $request->currency_position,
            'use_sign' => $request->use_sign,
            'logo_square' => $logo_square,
            'logo_rec' => $logo_rec,
            'favicon' => $favicon,
            'homepage' => $request->homepage,
        ];
        updateSite($settings);

        return response()->json(['message' => 'Core Settings updated successfully']);
    }

    // email setting
    public function email(Request $request)
    {
        $request->validate([
            'host' => 'required',
            'encryption' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'from_name' => 'required',
            'from_email' => 'required',
        ]);

        $mails = [
            'MAIL_HOST' => $request->host,
            'MAIL_ENCRYPTION' => $request->encryption,
            'MAIL_PORT' => $request->port,
            'MAIL_USERNAME' => $request->username,
            'MAIL_PASSWORD' => $request->password,
            'MAIL_FROM_NAME' => $request->from_name,
            'MAIL_FROM_ADDRESS' => $request->from_email,
        ];

        foreach ($mails as $key => $value) {
            updateEnvValue($key, $value);
        }

        return response()->json(['message' => 'Email SMTP Setting updated successfully']);
    }


    // test smtp connection
    public function emailTest(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        try {
            Mail::raw('SMTP connection test', function ($message) use ($email) {
                $message->to($email)
                    ->subject('SMTP Connection Test');
            });

            return response()->json(['message' => 'Test email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(validationError($e->getMessage()), 422);
        }
    }

    // deposit
    public function deposit(Request $request)
    {

        $request->validate([
            'deposit_coins' => 'required|array|min:1',
            'np_api_key' => 'required',
            'np_secret_key' => 'required',
            'min_deposit' => 'required|numeric',
            'max_deposit' => 'required|numeric',
            'deposit_fee' => 'required|numeric',
            'cp_public_key' => 'required',
            'cp_private_key' => 'required',
            'cp_merchant_id' => 'required',
            'payment_processor' => 'required'
        ]);

        // disable all coins
        DepositCoin::query()->update(['status' => 0]);

        // enable only those in request
        $coin_ids = $request->deposit_coins; //array
        DepositCoin::whereIn('id', $coin_ids)
            ->update(['status' => 1]);


        // update env
        updateEnvValue('NP_API_KEY', $request->np_api_key);
        updateEnvValue('NP_SECRET_KEY', $request->np_secret_key);
        updateEnvValue('COINPAYMENT_PUBLIC_KEY', $request->cp_public_key);
        updateEnvValue('COINPAYMENT_PRIVATE_KEY', $request->cp_private_key);
        updateEnvValue('COINPAYMENT_MARCHANT_ID',  $request->cp_marchant_id);

        // update min max fee
        updateSite([
            'min_deposit' => $request->min_deposit,
            'max_deposit' => $request->max_deposit,
            'deposit_fee' => $request->deposit_fee,
            'payment_processor' => $request->payment_processor,
        ]);


        return response()->json(['message' => 'Deposit setting updated successfully']);
    }


    // withdrawal
    public function withdrawal(Request $request)
    {

        $request->validate([
            'withdrawal_coins' => 'required|array|min:1',
            'min_withdrawal' => 'required|numeric',
            'max_withdrawal' => 'required|numeric',
            'withdrawal_fee' => 'required|numeric',
            'auto_withdraw' => 'required|numeric',
            'wallet_lock_duration' => 'required|numeric',
            'np_g2fa_secret' => 'required',
            'np_email' => 'required',
            'np_password' => 'required'
        ]);

        // disable all coins
        DepositCoin::query()->update(['can_withdraw' => 0]);

        // enable only those in request
        $coin_ids = $request->withdrawal_coins; //array
        DepositCoin::whereIn('id', $coin_ids)
            ->update(['can_withdraw' => 1]);

        // update min max fee
        updateSite([
            'min_withdrawal' => $request->min_withdrawal,
            'max_withdrawal' => $request->max_withdrawal,
            'withdrawal_fee' => $request->withdrawal_fee,
            'auto_withdraw' => $request->auto_withdraw,
            'wallet_lock_duration' => $request->wallet_lock_duration
            
        ]);

        $envs = [
            'np_g2fa_secret' => $request->np_g2fa_secret,
            'np_email' => $request->np_email,
            'np_password' => $request->np_password,
        ];

        foreach ($envs as $key => $value) {
            updateEnvValue(strtoupper($key), $value);
        }


        return response()->json(['message' => 'Withdrawal setting updated successfully']);
    }


    // bot
    public function bot(Request $request)
    {

        $request->validate([
            'days' => 'required|array|min:1',
            'bot_min_trade' => 'required|numeric',
            'bot_max_trade' => 'required|numeric',
            'bot_compounding' => 'required|numeric'
        ]);





        // update min max fee
        updateSite([
            'bot_min_trade' => $request->bot_min_trade,
            'bot_max_trade' => $request->bot_max_trade,
            'bot_compounding' => $request->bot_compounding,
            'trading_days' => json_encode($request->days)
        ]);


        return response()->json(['message' => 'Withdrawl setting updated successfully']);
    }



    // security
    public function security(Request $request)
    {
        $request->validate([
            'fields' => 'required|array|min:1',
            'strong_password' => 'required|numeric',
            'email_v' => 'required|numeric',
            'kyc_v' => 'required|numeric',
            'user_otp' => 'required|numeric',
            'admin_otp' => 'required|numeric'
        ]);






        updateSite([
            'strong_password' => $request->strong_password,
            'email_v' => $request->email_v,
            'kyc_v' => $request->kyc_v,
            'user_otp' => $request->user_otp,
            'kyc_v' => $request->kyc_v,
            'admin_otp' => $request->admin_otp
        ]);


        return response()->json(['message' => 'Security setting updated successfully']);
    }


    // contact
    public function contact(Request $request)
    {

        $request->validate([
            'email' => 'email'
        ]);

        updateSite([
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'phone' => $request->phone,
            'email' => $request->email,
            'livechat' => json_encode($request->livechat)
        ]);


        return response()->json(['message' => 'Contact setting updated successfully']);
    }



    // transfer
    public function transfer(Request $request)
    {

        $request->validate([
            'min_transfer' => 'required|numeric',
            'max_transfer' => 'required|numeric',
            'transfer_fee' => 'required|numeric'
        ]);


        // update min max fee
        updateSite([
            'min_transfer' => $request->min_transfer,
            'max_transfer' => $request->max_transfer,
            'transfer_fee' => $request->transfer_fee,
        ]);


        return response()->json(['message' => 'P2p Transfer setting updated successfully']);
    }



    // referral
    public function referral(Request $request)
    {

        $request->validate([
            'bonus' => 'required|array',
        ]);


        updateSite([
            'bonus' => json_encode($request->bonus)
        ]);


        return response()->json(['message' => 'Referral Bonus setting updated successfully']);
    }



    // misc
    public function misc(Request $request)
    {

        $request->validate([
            'pagination' => 'required|numeric',
            'preloader' => 'required|numeric',
        ]);


        updateSite([
            'pagination' => $request->pagination,
            'preloader' => $request->preloader,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'pinterest' => $request->pinterest,
            'snapchat' => $request->snapchat,
            'tiktok' => $request->tiktok,
            'reddit' => $request->reddit,
            'whatsapp' => $request->whatsapp,
        ]);


        return response()->json(['message' => 'Misc setting updated successfully']);
    }


    // update core
    public function seo(Request $request)
    {
        $request->validate([
            'robots' => 'required|max:255',
            'seo_description' => 'required',
            'cover' => 'image|mimes:png,jpg,jpeg|max:50000',

        ]);

        $path = 'assets/images/';

        $cover = site('cover');

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $file_name = 'cover.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $file_name);
            $cover = $file_name . '?v=' . time();
        }

        $settings = [
            'robots' => $request->robots,
            'seo_description' => $request->seo_description,
            'cover' => $cover

        ];
        updateSite($settings);

        return response()->json(['message' => 'SEO Settings updated successfully']);
    }


    // telegram settings
    public function telegram(Request $request)
    {

        
        $telegrams = [
            'TELEGRAM_BOT_TOKEN' => $request->telegram_bot_token ?? 'xxxxxxxxxxxx',
            'TELEGRAM_CHAT_ID' => $request->telegram_chat_id ?? 'xxxxx',
            'TELEGRAM_CHAT_GROUP_ID' => $request->telegram_chat_group_id ?? 'xxxxx',
            
        ];


        foreach ($telegrams as $key => $value) {
            updateEnvValue($key, $value);
        }

        return response()->json(['message' => 'Telegram settings updated']);
    }

    
}

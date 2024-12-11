<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessAutoWithdrawJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $wallet_address;
    protected $currency_lower;
    protected $converted_amount;
    protected $ref;
    /**
     * Create a new job instance.
     */
    public function __construct($wallet_address, $currency_lower, $converted_amount, $ref)
    {
        $this->wallet_address = $wallet_address;
        $this->currency_lower = $currency_lower;
        $this->converted_amount = $converted_amount;
        $this->ref = $ref;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // generate token
        $response = Http::post('https://api.nowpayments.io/v1/auth', [
            'email' => env('NP_EMAIL'),
            'password' => env('NP_PASSWORD'),
        ]);

        // Check if the request was successful
        if (!$response->successful()) {
            // Get the response body
            Log::error(json_encode($response->body()));
            return;
            // return response()->json(validationError('Error! Withdrawal Authentication failed'), 422);
        }

        $token = $data = $response->json();
        $token = $token['token'];

        $api_key = env('NP_API_KEY');
        $wallet_address = $this->wallet_address;
        $currency_lower = $this->currency_lower;
        $converted_amount = $this->converted_amount;
        $ref = $this->ref;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'x-api-key' => $api_key,
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/payout', [
            'ipn_callback_url' => route('withdrawal-callback'),
            'withdrawals' => [
                [
                    'address' => $wallet_address,
                    'currency' => $currency_lower,
                    'amount' => round($converted_amount, 6),
                    'ipn_callback_url' => route('withdrawal-callback'),
                ]
            ],
        ]);

        // Check if the request was successful
        $withdrawal = Withdrawal::where('ref', $ref)->first();
        if (!$response->successful()) {
            Log::error(json_encode($response->body()));
            // credit the user

            if ($withdrawal) {
                $update = Withdrawal::find($withdrawal->id);
                $update->status = 'rejected';
                $update->save();

                // credit the user
                $user = User::find($withdrawal->user_id);
                $new_bal = $user->balance + $withdrawal->amount;
                $user->balance = $new_bal;
                $user->save();

                recordNewTransaction($withdrawal->amount, $user->id, 'credit', 'Withdrawal reversal');
            }

            return;
        };

        $withdrawal_request = $response->json();
        $withdrawal_id = $withdrawal_request['id'];
        // update the ref
        if ($withdrawal) {
            $update = Withdrawal::find($withdrawal->id);
            $update->ref = 'trx-' . $withdrawal_id;
            $update->save();
        }
        // generate otp
        $np_g2fa_secret = env('NP_G2FA_SECRET');
        // Create a TOTP instance
        $otp = \OTPHP\TOTP::create($np_g2fa_secret);

        // Generate the OTP
        $generated_otp = $otp->now();

        // return here
        // return;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'x-api-key' => $api_key,
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/payout/' . $withdrawal_id .  '/verify', [
            'verification_code' => $generated_otp,
        ]);

        // Check if the request was successful
        if (!$response->successful()) {
            Log::error(json_encode($response->body()));
            return;
        }
    }
}

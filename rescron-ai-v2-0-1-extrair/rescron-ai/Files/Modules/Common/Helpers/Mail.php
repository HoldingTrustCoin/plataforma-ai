<?php

use App\Mail\ContactEmail;
use App\Mail\DepositConfirmedMail;
use App\Mail\KycMail;
use App\Mail\NewBotActivationMail;
use App\Mail\NewDepositMail;
use App\Mail\NewWithdrawalEmail;
use App\Mail\OtpMail;
use App\Mail\ReferrerMail;
use App\Mail\WelcomeMail;
use App\Mail\PasswordChangedMail;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


//send otp email
function sendOtp($email, $message = null, $admin = false)
{
    $otp = generateOTP($email, $admin);
    $code = $otp['code'];

    if (!env('DEMO_MODE')) {
        try {
            Mail::to($email)->send(new OtpMail($code, $message));
        } finally {
            return $code;
        }
    }

    return $code;
}

//send welcome email
function sendWelcomeEmail($user)
{
    if (!env('DEMO_MODE')) {
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } finally {
            return true;
        }
    }
}

//send referral email
function sendNewReferralEmail($ref, $user)
{

    if (!env('DEMO_MODE')) {
        try {
            Mail::to($ref->email)->send(new ReferrerMail($ref, $user));
        } finally {
            return true;
        }
    }
}

//user password updated
function sendPasswordChangedEmail($user)
{
    if (!env('DEMO_MODE')) {
        try {
            Mail::to($user->email)->send(new PasswordChangedMail($user));
        } finally {
            return true;
        }
    }
}


//notify kyc change
function sendKycMail($kyc)
{
    if (!env('DEMO_MODE')) {
        try {
            Mail::to($kyc->user->email)->send(new KycMail($kyc));
        } finally {
            return true;
        }
    }
}

//send deposit confirmed email to user
function sendDepositConfirmedMail($deposit)
{
    if (!env('DEMO_MODE')) {
        try {
            Mail::to($deposit->user->email)->send(new DepositConfirmedMail($deposit));
        } finally {
            return true;
        }
    }
}

function sendNewBotActivationMail($activation)
{
    if (!env('DEMO_MODE')) {
        try {
            Mail::to($activation->user->email)->send(new NewBotActivationMail($activation));
        } finally {
            return true;
        }
    }
}

function sendWithdrawalEmail($withdrawal)
{
    // fetch the withdrawal again
    $withdrawal = Withdrawal::where('id', $withdrawal->id)->first();
    if (!env('DEMO_MODE')) {
        try {
            Mail::to($withdrawal->user->email)->send(new NewWithdrawalEmail($withdrawal));
        } finally {
            return true;
        }
    }
}

function sendContactEmail($email, $subject, $message)
{
    if (!env('DEMO_MODE')) {
        try {
            Mail::to(site('email'))->send(new ContactEmail($email, $message, $subject));
        } finally {
            return true;
        }
    }
}

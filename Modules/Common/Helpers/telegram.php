<?php

use Telegram\Bot\Api;
Use Illuminate\Support\Str;

function sendMessageTelegram($message)
{
    // Replace with your actual bot token
    $botToken = env('TELEGRAM_BOT_TOKEN');

    // Replace with your channel username or ID
    $chatId = '-' . env('TELEGRAM_CHAT_ID');
    $chatId = str_replace('--', '-', $chatId);

    $message = str_replace('.', '\.', $message);
    $message = str_replace('-', '\-', $message);

    // Initialize the Telegram bot
    $telegram = new Api($botToken);
    try {
        $response = $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'MarkdownV2' 
        ]);
    } catch(Exception $e)  {
        //throw $th;
    }

    if (Str::contains($message, 'Withdrawal')) {
        $group_id = '-' . env('TELEGRAM_CHAT_GROUP_ID');
        $group_id = str_replace('--', '-', $group_id);
        try {
            $to_chat = $telegram->sendMessage([
                'chat_id' => $group_id,
                'text' => $message,
                'parse_mode' => 'MarkdownV2' 
            ]);
        } catch(Exception $e) {
            //
        }
    }

    // return $response->getMessageId();
    return true;
}

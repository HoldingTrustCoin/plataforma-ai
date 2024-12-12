<x-mail::message>
# Deposit Confirmed

Hi {{ $deposit->user->username }},

Your deposit request of {{ formatAmount($deposit->amount) }} has been confirmed. Login into your account to activate a trading bot.


Thanks,<br>
{{ site('name') }}
</x-mail::message>

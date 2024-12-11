<x-mail::message>
# Trading Bot Activation Successful

Hi {{ $activation->user->username  }},

You have successfully activated {{ $activation->bot->name }} trading bot.

Thanks,<br>
{{ site('name') }}
</x-mail::message>

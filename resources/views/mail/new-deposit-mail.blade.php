<x-mail::message>
# Deposit Initiated

Hi {{ $deposit->user->username }},

Your deposit request of {{ formatAmount($deposit->amount) }} has been received. You will be notified via when your deposit is processed.


Thanks,<br>
{{ site('name') }}
</x-mail::message>

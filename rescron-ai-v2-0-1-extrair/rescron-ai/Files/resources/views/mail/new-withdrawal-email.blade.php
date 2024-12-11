<x-mail::message>
#  Withdrawal {{ $withdrawal->status }}

Hi {{ $withdrawal->user->username }},

@if ($withdrawal->status == 'pending') 
Your withdrawal request of {{ formatAmount($withdrawal->amount - $withdrawal->fee) }} has been received. You will get an email update when your withdrawal is processed.
@elseif($withdrawal->status == 'approved')
Your withdrawal request of {{ formatAmount($withdrawal->amount - $withdrawal->fee) }} has been approved.
@else 
Your withdrawal request of {{ formatAmount($withdrawal->amount - $withdrawal->fee) }} has been rejected.
@endif


Thanks,<br>
{{ site('name') }}
</x-mail::message>

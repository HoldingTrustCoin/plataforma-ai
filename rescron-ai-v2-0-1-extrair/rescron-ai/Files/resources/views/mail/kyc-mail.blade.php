<x-mail::message>
# Kyc Record Updated

Hi {{ $kyc->user->name }},

Your KYC record has been updated. You will be notified by email once the status is updated. 

<x-mail::panel>
Current Status: {{ $kyc->status }}
</x-mail::panel>

Thanks,<br>
{{ site('name') }}
</x-mail::message>

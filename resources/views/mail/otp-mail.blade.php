<x-mail::message>
# One Time Passcode

@if ($message)
{!! $message !!}

@else
There has been a login attempt on your account. Kindly the OTP code below to authorize the login
@endif



<x-mail::panel>
{{ $code }}
</x-mail::panel>

Thanks,<br>
{{ site('name') }}
</x-mail::message>

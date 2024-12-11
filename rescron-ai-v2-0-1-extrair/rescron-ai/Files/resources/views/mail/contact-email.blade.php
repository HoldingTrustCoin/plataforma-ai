<x-mail::message>
# {{ $subject }}

You have received a contact email request from {{ $email }}

<br><br>

{!! $message !!}

Thanks,<br>
{{ site('name') }}
</x-mail::message>

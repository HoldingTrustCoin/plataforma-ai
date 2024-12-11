<x-mail::message>
# Welcome to {{ site('name') }}

Hi {{ $user->name }},

Your account with email {{ $user->email }} has been created successfully.

More texts later



Thanks,<br>
{{ site('name') }}
</x-mail::message>

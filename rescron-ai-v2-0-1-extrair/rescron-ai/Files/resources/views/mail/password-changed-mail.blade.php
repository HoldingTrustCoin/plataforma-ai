<x-mail::message>
# Password Changed

Hi {{ $user->name }},

Your password was recently changed. Contact admin if you this was not done by you.

Thanks,<br>
{{ site('name') }}
</x-mail::message>

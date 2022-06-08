@component('mail::message')

Hey, you have something in your bag and after this message to show table with added products.

<a href="{{ url($data['url']) }}">Click here</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

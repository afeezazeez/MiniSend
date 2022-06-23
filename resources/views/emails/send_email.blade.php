@component('mail::message')

{!!$email->html_content!!}


Thanks,<br>
{{ config('app.name') }}
@endcomponent

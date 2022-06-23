@component('mail::message')

{!!$email->text_content!!}


Thanks,<br>
{{ config('app.name') }}
@endcomponent

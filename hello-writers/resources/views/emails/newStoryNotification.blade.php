@component('mail::message')
# Hello, Admin

A New Story was added with Title:{{$title}}.

@component('mail::button', ['url' => route('dashboard.index')])
Go to HomePage
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

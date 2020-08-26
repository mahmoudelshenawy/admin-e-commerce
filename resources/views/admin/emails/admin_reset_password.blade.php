@component('mail::message')
Hello {{$data['data']->name}}

The body of your message.

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Click Here To Reset Your Password
@endcomponent
<br>
Or Copy this Link: <a href="{{ aurl('reset/password/'.$data['token']) }}">{{aurl('reset/password/'.$data['token'])}}</a>
<br>
{{ config('app.name') }}
@endcomponent

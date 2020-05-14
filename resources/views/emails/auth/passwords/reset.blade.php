@component('mail::message')



Hello {{$client->name}}

Blood Bank Password Reset



<p>Your reset code is : {{$client->pin_code}}</p>



@component('mail::button', ['url' => 'http://www.google.com'])
Reset Password
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent

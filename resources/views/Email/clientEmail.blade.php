@component('mail::message')
 {{ $mailData['title'] }}

 {{ $mailData['Description'] }}

@component('mail::button', ['url' => $mailData['url']])
Visit Site
@endcomponent

Thanks,<br>
https://dsms.jhamt.com
@endcomponent

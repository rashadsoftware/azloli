@component('mail::message')
Salam, {{$user_name}}

Əgər Siz şifrəni dəyişmək üçün müraciət etməmisinizsə, bu məktubu nəzərə almayın.

Sizin şifrəniz link vasitəsilə keçmədiyiniz və yeni şifrə yaratmadığınız vaxta qədər dəyişməz qalacaq.

@component('mail::button', ['url' => route('password.reset', $reset_code)])
Şifrəni dəyişmək üçün tıklayın
@endcomponent

<p>Vəya linki kopyalayıb brauzerinizdə yerləşdirin</p>
<p><a href="{{route('password.reset', $reset_code)}}">{{route('password.reset', $reset_code)}}</a></p>

Təşəkkürlər,<br>
AZLoli komandası
@endcomponent

@component('mail::message')
<table width="100%" style="text-align: center; margin-bottom: 20px;">
    <tr>
        <td>
            <img src="{{ $cityLogoCid }}" alt="City Logo" style="height: 80px; margin-right: 10px;">
            <img src="{{ $yakapLogoCid }}" alt="Yakap Logo" style="height: 80px;">
        </td>
    </tr>
</table>

# Welcome to Yakap!

Thank you for registering.

Your One-Time Password (OTP) is:

@component('mail::panel')
**{{ $otp }}**
@endcomponent

Please use this code to verify your account.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
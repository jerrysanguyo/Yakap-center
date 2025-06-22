@component('mail::message')
<table width="100%" style="text-align: center; margin-bottom: 20px;">
    <tr>
        <td>
            <img src="{{ $cityLogoCid }}" alt="City Logo" style="height: 80px; margin-right: 10px;">
            <img src="{{ $yakapLogoCid }}" alt="Yakap Logo" style="height: 80px;">
        </td>
    </tr>
</table>

# Interview Schedule Notification

Dear Parent/Guardian,

We are pleased to inform you that your child has been scheduled for an **interview** as part of the assessment process
at the **Taguig Yakap Center**.

📅 **Date of Interview:**
**{{ \Carbon\Carbon::parse($schedule->date)->format('F j, Y') }}**

📝 **Remarks:**
{{ $schedule->remarks }}

Please ensure that your child is present on the specified date. Should you have any questions or need to reschedule,
feel free to contact us.

Thank you for your continued cooperation and support.

Best regards,
**Taguig Yakap Center**

@endcomponent
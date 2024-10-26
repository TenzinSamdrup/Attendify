@component('mail::message')
# Leave Request Update

Hello {{ $leave->user->name }},

Your leave request from **{{ $leave->start_date }}** to **{{ $leave->end_date }}** has been **{{ $leave->status }}**.

Thank you for your attention.

Best regards,  
Attendify Team
@endcomponent

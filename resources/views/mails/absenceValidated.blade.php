<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('your_absence_has_been_validated') }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #2c3e50;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #34495e;
        }
        .highlight {
            color: #16a085;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>{{ __('hello') }} {{ $user->prenom }},</h1>
        <p>{{ __('we_want_to_inform_you') }} {{ __('your_absence') }} {{ __('from') }} <span class="highlight">{{ $absence->date_debut }}</span> {{ __('to') }} <span class="highlight">{{ $absence->date_fin }}</span> {{ __('has_been_validated') }} {{ __('by_our_service') }}</p>
        <p>{{ __('you_will_receive_a_notification') }} {{ __('in_case_of_modification') }} {{ __('meanwhile_you_can_check') }} {{ __('the_details_of_your_absence') }} {{ __('via_your_personal_space') }}.</p>
        <a href="#" class="btn">{{ __('view_my_absence') }}</a>
        <p class="footer">{{ __('thank_you_for_your_trust') }}<br>{{ __('the_hr_team') }}</p>
    </div>
</body>
</html>

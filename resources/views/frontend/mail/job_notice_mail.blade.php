<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Notification E-mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .detail-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .detail-section p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Hello {{ $mailData['employer']->name }}</h1>
        <p>We are pleased to inform you about a new application for the following job position:</p>
        <p><strong>Job Title:</strong> {{ $mailData['job']->job_name }}</p>

        <div class="detail-section">
            <p><strong>Applicant Details:</strong></p>
            <p><strong>Name:</strong> {{ $mailData['user']->name }}</p>
            <p><strong>Email:</strong> {{ $mailData['user']->email }}</p>
            <p><strong>Mobile No:</strong> {{ $mailData['user']->mobile }}</p>
        </div>

        <div class="footer">
            <p>Thank you for using our platform. If you have any questions, feel free to contact us.</p>
        </div>
    </div>
</body>
</html>

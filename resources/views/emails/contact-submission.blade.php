<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELDITECH Contact Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #1f2937;">
    <h2 style="margin-bottom: 16px;">New Contact Submission</h2>

    <p><strong>Name:</strong> {{ $payload['name'] }}</p>
    <p><strong>Email:</strong> {{ $payload['email'] }}</p>
    <p><strong>Subject:</strong> {{ $payload['subject'] }}</p>
    <p><strong>Locale:</strong> {{ $payload['locale'] }}</p>
    <p><strong>Source:</strong> {{ $payload['source'] }}</p>

    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #e5e7eb;">

    <h3 style="margin-bottom: 8px;">Message</h3>
    <p style="white-space: pre-wrap;">{{ $payload['message'] }}</p>
</body>
</html>

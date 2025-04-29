<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - GadgetHubb</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #2c2a29, #545352);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            background: #737070;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #545252;
        }

        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
        }

        .error {
            background: rgba(255, 0, 0, 0.1);
            color: red;
        }

        .success {
            background: rgba(0, 128, 0, 0.1);
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Forgot Password?</h2>
        <p>Enter your email address to receive an OTP.</p>
        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('sendOtp') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Send OTP</button>
        </form>
    </div>
</body>

</html>

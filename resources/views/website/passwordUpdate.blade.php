<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - GadgetHubb</title>
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

        .error-message {
            background: #ffdddd;
            color: #d8000c;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            display: block;
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
    </style>
</head>

<body>
    <div class="container">
        <h2>Enter OTP & New Password</h2>

        <!-- Display all errors -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Show session error messages -->
        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('verifyOtp') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <input type="password" name="password" placeholder="New Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit">Update Password</button>
        </form>
    </div>
</body>

</html>

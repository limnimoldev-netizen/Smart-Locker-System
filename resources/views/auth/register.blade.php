<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Smart Locker System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            background: #eef1f6;
            font-family: 'Poppins', sans-serif;
        }

        .screen {
            width: 100%;
            max-width: 420px;
            min-height: 100vh;
            background: #f7f8fa;
            padding: 64px 32px 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo { width: 200px; height: auto; object-fit: contain; margin-bottom: 4px; }
        .title { margin: 0; font-size: 22px; font-weight: 600; color: #0f172a; }
        .subtitle { margin: 8px 0 36px; font-size: 13px; color: #1e293b; text-align: center; }

        .form { width: 100%; }
        .field { display: flex; flex-direction: column; margin-bottom: 16px; }
        .field label { font-size: 13px; font-weight: 500; color: #0f172a; margin-bottom: 8px; }

        .field input {
            height: 40px;
            padding: 0 14px;
            border: 1px solid #dbe1ea;
            border-radius: 10px;
            background: #fff;
            font-family: inherit;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .field input:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, .12);
        }

        .field input.is-invalid { border-color: #dc2626; }

        .error { margin: 6px 0 0; font-size: 12px; color: #dc2626; }

        .btn {
            width: 100%;
            height: 44px;
            margin-top: 18px;
            border: none;
            border-radius: 10px;
            background: #1e3a8a;
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            cursor: pointer;
            transition: background .2s;
        }

        .btn:hover { background: #172f6e; }

        .login-link { margin: 14px 0 0; text-align: center; font-size: 13px; color: #0f172a; }
        .login-link a { color: #1e3a8a; font-weight: 500; text-decoration: none; }
    </style>
</head>
<body>
    <main class="screen">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Smart Locker Logo" class="logo">

        <h1 class="title">Create your account</h1>
        <p class="subtitle">Sign up to start using smart lockers</p>

        <form class="form" method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="field">
                <label for="name">Full Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                    autofocus
                    class="@error('name') is-invalid @enderror"
                >
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    class="@error('email') is-invalid @enderror"
                >
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="phone">Phone Number</label>
                <input
                    id="phone"
                    type="tel"
                    name="phone"
                    value="{{ old('phone') }}"
                    autocomplete="tel"
                    required
                    class="@error('phone') is-invalid @enderror"
                >
                @error('phone')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    required
                    class="@error('password') is-invalid @enderror"
                >
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    required
                    class="@error('password_confirmation') is-invalid @enderror"
                >
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn" type="submit">Register</button>

            <p class="login-link">
                Already registered? <a href="{{ route('login') }}">Login</a>
            </p>
        </form>
    </main>
</body>
</html>
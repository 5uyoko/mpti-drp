@if (Auth::check())
    <script>
        window.location.href = "/home";
    </script>
@endif

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('gambar/sistem/pavicon.png') }}">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: #ffffff;
            width: 420px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .login-box .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .login-box .logo img {
            height: 80px;
        }

        .login-box h3 {
            text-align: center;
            color: #002b5b;
            margin-top: 15px;
            font-weight: 700;
        }

        .login-box h4 {
            text-align: center;
            color: #555;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-primary {
            width: 100%;
            background-color: #003366;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #002244;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 8px;
        }

        .form-check-label {
            font-size: 14px;
            color: #333;
        }

        .btn-link {
            font-size: 13px;
            color: #666;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            text-align: right;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="logo">
            <img src="{{ asset('gambar/sistem/logo1.png') }}" alt="Logo">
        </div>
        <h3>PT. RAMADHANI PERMAI SHIPPING</h3>
        <h4>Sistem Informasi Pengelola Keuangan</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input id="email" type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="off">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">LOGIN</button>
                @if (Route::has('password.request'))
                    <a class="btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #ededed;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 2rem;
            color: #333;
        }

        .form-container label {
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .remember-me {
            text-align: left;
            margin-bottom: 1rem;
        }

        .remember-me label {
            display: inline-block;
            vertical-align: middle;
            margin-right: 0.5rem;
        }

        .form-container button {
            background-color: #333;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .form-container button:hover {
            background-color: #555;
        }

        .form-container .forgot-password {
            text-decoration: none;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Login</h2>

            <!-- Session Status -->
            @if (session('status'))
                <div>{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Senha</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Lembrar-me</label>
                </div>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">Esqueceu sua senha?</a>
                @endif

                <!-- Submit Button -->
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>

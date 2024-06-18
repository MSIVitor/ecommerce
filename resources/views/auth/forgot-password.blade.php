<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
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

        .form-container input[type="email"] {
            width: calc(100% - 20px);
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 1rem;
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

        .form-container .message {
            margin-bottom: 1.5rem;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Redefinir Senha</h2>
            <div class="message">
                Esqueceu sua senha? Sem problemas. Apenas nos informe seu endereço de e-mail e enviaremos um link de redefinição de senha para você.
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div>
                    <button type="submit">Enviar Link de Redefinição de Senha</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

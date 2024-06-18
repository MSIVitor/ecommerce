<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Email</title>
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

        .form-container p {
            margin-bottom: 1.5rem;
            color: #777;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Verificar Email</h2>
            <p>Obrigado por se cadastrar! Antes de começar, poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se não recebeu o e-mail, ficaremos felizes em enviar outro.</p>
            @if (session('status') == 'verification-link-sent')
                <p>Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.</p>
            @endif
            <div class="flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit">Reenviar Email de Verificação</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

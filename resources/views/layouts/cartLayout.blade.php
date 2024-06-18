<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot Suplementos</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <h1>Hot Suplementos</h1>
    </div>
    <nav>
        <div class="menu">
            <div class="menu-items">
                <a href="#home">Início</a>
                <a href="#produtos">Produtos</a>
                <a href="#sobre">Sobre Nós</a>
                <a href="#contato">Contato</a>
            </div>
        </div>
    </nav>
    <div class="login-register">
        @guest
            <a href="{{ route('login') }}">{{ __('Login') }}</a>&nbsp|&nbsp
            <a href="{{ route('register') }}">{{ __('Registrar') }}</a>
        @endguest

        @auth
            <span>{{ Auth::user()->name }}</span>&nbsp &nbsp &nbsp &nbsp     |&nbsp
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </div>
</header>

@yield('content')

<section id="contato" class="container">
    <p>Entre em contato conosco pelo e-mail: contato@hotsuplementos.com</p>
</section>

<footer>
    <p>&copy; 2024 HOT Suplementos. Todos os direitos reservados.</p>
</footer>

<script src="/js/script.js"></script>
</body>
</html>

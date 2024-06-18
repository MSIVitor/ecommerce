@extends('layouts.layout')

@section('title', 'Loja de Suplementos')

@section('content')
    <section id="home">
        <div class="hero">
            <h2>Bem-vindo à Loja de Suplementos</h2>
            <p>Encontre os melhores suplementos para a sua saúde e bem-estar.</p>
            <a href="#produtos" class="btn">Ver Produtos</a>
        </div>
    </section>

    <section id="produtos" class="container">
        <h2>Produtos em Destaque</h2>
        <div class="produtos-grid">
            @foreach ($products as $product)
                <div class="produto">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p>A partir de R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                    </a>
                    <a href="{{ route('product.show', $product->id) }}" class="btn">Comprar</a>
                </div>
            @endforeach
        </div>
    </section>

    <section id="sobre" class="container">
        <h2>Sobre Nós</h2>
        <p>Somos uma loja de suplementos dedicada a oferecer produtos de alta qualidade para atletas e entusiastas da saúde.</p>
    </section>

    <section id="contato" class="container">
        <h2>Contato</h2>
        <p>Entre em contato conosco pelo e-mail: contato@hotsuplementos.com</p>
    </section>
@endsection

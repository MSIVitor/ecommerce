@extends('layouts.cartLayout')

@section('title', 'Carrinho de Compras')

@section('content')
<section id="carrinho" class="container1">
    <h2>Carrinho de Compras</h2>

    @if ($cartItems->isEmpty())
        <p>Seu carrinho está vazio.</p>
    @else
        <div class="cart-items">
            @foreach ($cartItems as $item)
                <div class="cart-item">
                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                    <div class="cart-item-details">
                        <h3>{{ $item->product->name }}</h3>
                        <p>{{ $item->product->description }}</p>
                        <p>Quantidade: {{ $item->quantity }}</p>
                        <p>Preço: R$ {{ number_format($item->product->price, 2, ',', '.') }}</p>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn remove">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="cart-total">
            <h3>Total: R$ {{ number_format($total, 2, ',', '.') }}</h3>
        </div>

        <div class="cart-actions">
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <button type="submit" class="btn finalizar-compra">Finalizar Compra</button>
            </form>
        </div>
    @endif
</section>
@endsection
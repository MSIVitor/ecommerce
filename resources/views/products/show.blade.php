@extends('layouts.product')

@section('title', $product->name)

@section('content')
    <section id="produto-detalhes" class="container">
        <div class="produto">
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
            <div class="info">
                <br><br>
                <h2>{{ $product->name }}</h2>
                <p class="descricao">{{ $product->description }}</p><br><br><br><br><br>
                <p class="preco">A partir de R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="preco-parcelado">Em até 12x de R$ {{ number_format($product->price / 12, 2, ',', '.') }} sem juros</p>
                @if ($product->pix > 0)
                    <p class="preco-pix">Preço pelo Pix: R$ {{ number_format($product->price - $product->pix, 2, ',', '.') }}</p>
                @endif
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="form-compra">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-carrinho">Adicionar ao Carrinho</button> &nbsp
                    <button type="button" class="btn-compras" onclick="finalizarCompra()">Finalizar Compra</button>
                </form>
            </div>
        </div>
    </section>
@endsection

<script>
    function finalizarCompra() {
    }
</script>

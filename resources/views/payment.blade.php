@extends('layouts.layout')

@section('title', 'Formulário de Pagamento')

@section('content')
    <section id="payment-form" class="container">
        <h2>Formulário de Pagamento</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form id="checkout-form" method="POST" action="{{ route('payment.process') }}">
            @csrf
            <div class="form-group">
                <label for="cardholder-name">Nome do Titular</label>
                <input id="cardholder-name" type="text" placeholder="Nome do Titular" required>
            </div>

            <div class="form-group">
                <label for="card-element">Dados do Cartão</label>
                <div id="card-element">
                    <!-- Stripe Card Element será inserido aqui -->
                </div>
                <!-- Erros serão mostrados aqui -->
                <div id="card-errors" role="alert"></div>
            </div>

            <div class="form-group">
                <label for="country">País ou Região</label>
                <input id="country" type="text" placeholder="País ou Região" required>
            </div>

            <div class="form-group">
                <label for="postal-code">CEP</label>
                <input id="postal-code" type="text" placeholder="CEP" required>
            </div>

            <button id="submit-button" type="submit">Pagar</button>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env("STRIPE_PUBLIC_KEY") }}');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var cardElement = elements.create('card', {style: style});
        cardElement.mount('#card-element');

        var form = document.getElementById('checkout-form');
        var submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var cardholderName = document.getElementById('cardholder-name').value;
            var country = document.getElementById('country').value;
            var postalCode = document.getElementById('postal-code').value;

            
            stripe.createToken(cardElement, {
            name: cardholderName,
            address_country: country,
            address_zip: postalCode,
        }).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('checkout-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>

<link rel="stylesheet" href="/css/checkout.css">
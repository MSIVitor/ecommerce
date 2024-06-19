<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function handlePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $charge = Charge::create([
                'amount' => 1000, 
                'currency' => 'usd',
                'description' => 'Pagamento de Exemplo',
                'source' => $request->stripeToken,
            ]);

            return redirect()->back()->with('success', 'Pagamento realizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

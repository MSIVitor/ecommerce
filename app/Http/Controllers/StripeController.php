<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use App\Models\Cart;

class StripeController extends Controller
{
    /**
     * Handle the checkout process.
     *
     * @return RedirectResponse
     * @throws ApiErrorException
     */
    public function checkout(): RedirectResponse
    {
        Stripe::setApiKey(config('stripe.test.sk'));

        // Retrieve cart items for the authenticated user
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Prepare line items for Stripe
        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency'     => 'brl', 
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount'  => $item->product->price * 100, 
                ],
                'quantity'   => $item->quantity,
            ];
        })->toArray();

        // Create a checkout session
        $session = Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('cart.index'),
        ]);

        return redirect()->away($session->url);
    }

    /**
     * Display success page.
     *
     * @return \Illuminate\View\View
     */
    public function success()
    {
        return view('success');
    }
}

<?php

namespace App\Services\Payments;

use App\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Stripe\StripeClient;
use App\Models\payment;
use Illuminate\Support\Facades\Auth;

class StripePayment
{
    public function createCheckoutSession(Subscription $subscription): Response
    {
        // عشان نرجع قيمة من الservice container
        // $stripe = app(StripeClient::class);
        // $stripe = app()->make(StripeClient::class);
        $stripe = App::make(StripeClient::class);

        $checkout_session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'], // You might need to specify the payment method types you accept.
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $subscription->plan->name,
                        ],
                        'unit_amount' => $subscription->plan->price * 100, // Amount should be in cents.
                    ],
                    'quantity' => $subscription->expires_at->diffInMonths($subscription->created_at),
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payments.success', $subscription->id),
            'cancel_url' => route('payments.cancel', $subscription->id),
            'metadata' => [
                'subscription_id' => $subscription->id,
            ],
            'customer_email' => $subscription->user->email,
            'client_reference_id' => $subscription->id,
        ]);

        Payment::forceCreate([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price * 100,
            'currency_code' => 'usd',
            'payment_gateway' => 'stripe',
            'gateway_reference_id' => $checkout_session->id,
            'data' => $checkout_session,
        ]);
        return redirect()->away($checkout_session->url);
    }
}

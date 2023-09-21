<?php

namespace App\Actions\Stripe;

use App\Models\Subscription;
use Stripe\StripeClient;

class CreatePaymentIntent
{
    public function paymentIntent(StripeClient $stripe, Subscription $subscription)
    {
       return $stripe->paymentIntents->create([
            'amount' => $subscription->price * 100,
            'currency' => 'usd',
            // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
    }
}
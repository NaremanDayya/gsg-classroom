<?php

namespace App\Http\Controllers;

use App\Actions\Stripe\CreatePaymentIntent;
use App\Models\Subscription;
use App\Services\Payments\StripePayment;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Stripe\StripeClient;

class paymentsController extends Controller
{

    public function create(StripePayment $stripe, Subscription $subscription)
    {
        return $stripe->createCheckoutSession($subscription);
    }

    public function store(Request $request,StripeClient $stripe,Subscription $subscription,CreatePaymentIntent $intent)
    {

        $subscription = Subscription::findOrFail($request->id);
        try {
            $paymentIntent = $intent->paymentIntent($stripe, $subscription);
            return [
                'clientSecret' => $paymentIntent->client_secret,
            ];
        } catch (Error $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function success(Request $request)
    {
        return view('payments.success');
    }

    public function cancel(Request $request)
    {
        return view('payments.cancel');
    }
}

<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment;
use App\Models\Subscription;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function  __invoke(Request $request, StripeClient $stripe)
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_96ea07a932795bfadf78f3be8fdda6c57f3cf6eabaf4628a6fcfa515030e1d0d';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            //empty response بس لانه بده يعرف اذا انا استلمت ال webhook او لا بس 
            return response('',400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('',400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.async_payment_failed':
                $session = $event->data->object;
                break;
            case 'checkout.session.async_payment_succeeded':
                $session = $event->data->object;
                break;
            case 'checkout.session.completed':
                $session = $event->data->object;
                $payment = Payment::where('gateway_reference_id', $session->id)->first();
                if ($payment) {
                    $payment->forceFill([
                        'gateway_reference_id' => $session->payment_intent,
                    ])->save();
                }
                break;
            case 'checkout.session.expired':
                $session = $event->data->object;
                break;
            case 'payment_intent.amount_capturable_updated':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.canceled':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.created':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.partially_funded':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.requires_action':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $payment = Payment::where('gateway_reference_id', $paymentIntent->id)->first();
                $payment->update([
                    'status' => 'completed',
                ]);
                $subscription = Subscription::where('id', $payment->subscription_id)->first();
                $subscription->update([
                    'status' => 'active',
                    'expires_at' => now()->addMonths(3),
                ]);
                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        // http_response_code(200);
        return response('', 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Event;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('seller.subscription.index');
    }

    public function create(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'mode' => 'subscription',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => env('STRIPE_SUBSCRIPTION_PRICE'),
                'quantity' => 1,
            ]],
            'customer_email' => auth()->user()->email,
            'success_url' => route('subscribe.success'),
            'cancel_url' => route('subscribe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $user = auth()->user();
        $user->is_subscribed = true;
        $user->save();

        return view('seller.subscription.success');
    }

    public function cancel()
    {
        return view('seller.subscription.cancel');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->server('HTTP_STRIPE_SIGNATURE');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\Exception $e) {
            return response('Invalid', 400);
        }

        if ($event->type == 'customer.subscription.created') {
            $subscription = $event->data->object;
            $user = User::where('email', $subscription->customer_email)->first();

            if ($user) {
                $user->is_subscribed = true;
                $user->stripe_subscription_id = $subscription->id;
                $user->save();
            }
        }

        if ($event->type == 'customer.subscription.deleted') {
            $subscription = $event->data->object;
            $user = User::where('stripe_subscription_id', $subscription->id)->first();

            if ($user) {
                $user->is_subscribed = false;
                $user->save();
            }
        }

        return response('OK', 200);
    }
}

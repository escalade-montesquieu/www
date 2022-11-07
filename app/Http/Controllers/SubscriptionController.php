<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use Response;
use Validator;

class SubscriptionController extends Controller
{
    public function all(Request $request) {
        if (request('key') !== config('services.pusher.key')) {
            return response()->json('error',400);
        }
        $subscriptions = Subscription::all();

        return response()->json(compact('subscriptions'));
    }

    public function add(Request $request) {
        if (request('key') !== config('services.pusher.key')) {
            return response()->json('error',400);
        }
        $subscription = Subscription::create([
            'auth' => request('auth'),
            'endpoint' => request('endpoint'),
            'keys' => request('keys'),
        ]);

        return response()->json(compact('subscription'));
    }

    public function delete(Request $request) {
        if (request('key') !== config('services.pusher.key')) {
            return response()->json('error',400);
        }

        if(!$subscription = Subscription::where('auth', request('auth'))) {
            return response()->json('subscription not found',404);

        }
        $subscription->delete();

        return response()->json('deleted',200);
    }
}

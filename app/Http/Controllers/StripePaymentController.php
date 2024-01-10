<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Stripe;
use Stripe\Customer;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    public function stripe()
    {

        return view('frontend.pages.index');
    }

    public function stripePost(Request $request)

    {
        // dd($request->all());

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        $customer = Stripe\Customer::create(array(

            "address" => [

                "line1" => $request->input('shipping-address'),

                "postal_code" => $request->input('billing-zip'),

                "city" => "Burewala",

                "state" => $request->input('shipping-address'),

                "country" => 'Pakistan',

            ],

            "email" => $request->input('email'),

            "name" => $request->input('name'),

            "source" => $request->stripeToken

        ));



        Stripe\Charge::create([

            "amount" => $request->input('amount') * 100,

            "currency" => "usd",

            "customer" => $customer->id,

            "description" => "Test payment from Faizan.",

            "shipping" => [

                "name" => "FAIZAN",

                "address" => [

                    "line1" => "510 Townsend St",

                    "postal_code" => "61010",

                    "city" => "Burewala",

                    "state" => "CA",

                    "country" => "US",

                ],

            ]

        ]);



        Session::flash('success', 'Payment successful!');



        return back();
    }
}

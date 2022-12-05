@extends('stripemenu')

@section('content')

    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css">
    <script src="https://js.stripe.com/v3/"></script>

        <style>
            @import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic);

            body {
                background: #e4e5e5;
                color: #111;
                min-width: 320px;
                font-size: 16px;
                font-weight: 300;
                line-height: 1.6;
                -webkit-font-smoothing: antialiased;
                -webkit-backface-visibility: hidden;
                position: relative;
                padding: 50px 20px;
            }

            .pricing {
                text-align: center;
                border: 1px solid #f0f0f0;
                color: #777;
                font-size: 14px;
                padding-left: 0;
                margin-bottom: 30px;
                font-family: 'Lato';
            }

            .pricing img {
                display: block;
                margin: auto;
                width: 32px;
            }

            .pricing li:first-child,
            .pricing li:last-child {
                padding: 20px 13px;
            }

            .pricing li {
                list-style: none;
                padding: 13px;
            }

            .pricing li+li {
                border-top: 1px solid #f0f0f0;
            }

            .pricing big {
                font-size: 32px;
            }

            .pricing h3 {
                margin-bottom: 0;
                font-size: 36px;
            }

            .pricing span {
                font-size: 12px;
                color: #999;
                font-weight: normal;
            }

            .pricing li:nth-last-child(2) {
                padding: 30px 13px;
            }

            .pricing button {
                width: auto;
                margin: auto;
                font-size: 15px;
                font-weight: bold;
                border-radius: 50px;
                color: #fff;
                padding: 9px 24px;
                background: #aaa;
                opacity: 1;
                transition: opacity .2s ease;
                border: none;
                outline: none;
            }

            .pricing button:hover {
                opacity: .9;
            }

            .pricing button:active {
                box-shadow: inset 0px 2px 2px rgba(0, 0, 0, 0.1);
            }

            /* pricing color */
            .p-green big,
            .p-green h3 {
                color: #4c7737;
            }

            .p-green button {
                background: #4c7737;
            }

            .p-yel big,
            .p-yel h3 {
                color: #ffbb42;
            }

            .p-yel button {
                background: #ffbb42;
            }

            .p-red big,
            .p-red h3 {
                color: #e13c4c;
            }

            .p-red button {
                background: #e13c4c;
            }

            .p-blue big,
            .p-blue h3 {
                color: #3f4bb8;
            }

            .p-blue button {
                background: #3f4bb8;
            }

            .StripeElement {
                background-color: white;
                padding: 8px 12px;
                border-radius: 4px;
                border: 1px solid transparent;
                box-shadow: 0 1px 3px 0 #e6ebf1;
                -webkit-transition: box-shadow 150ms ease;
                transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
                box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
                border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }
            button#checkout-button {
    width: 100%;
    padding: 10px 10px;
    border-radius: 5px;
    border: none;
    text-transform: uppercase;
    background-color: #635bff;
    color: #ffffff;
    font-family: montserratRegular;
}
        </style>
    </head>
    <?php
    require_once __DIR__.'/../../../vendor/autoload.php';
    $stripe = new \Stripe\StripeClient("sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP");

    $checkout_session = $stripe->checkout->sessions->create([
      'line_items' => [[
        'price_data' => [
          'currency' => 'usd',
          'product_data' => [
            'name' => 'T-shirt',
          ],
          'unit_amount' => 2000,
        ],
        'quantity' => 1,
      ]],
      'mode' => 'payment',
      'success_url' => 'http://localhost/multiple-payments/single-stripe',
      'cancel_url' => 'http://localhost/multiple-payments/single-stripe',
    ]);


    ?>
    <body>
        <section class="container">
            <div class="row white">
                <div class="block">

                    <button id="checkout-button" type="button" class="btn btn-primary">Checkout</button>


                </div><!-- /block -->
            </div><!-- /row -->
        </section>
        {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
    </body>
    </html>
    <script>

    const stripe = Stripe("pk_test_51KhLF7J5CNuTNvMY0ZnpLa54MJo7VP9uFwD2HgN5RWs5JSWFcG8DivDwFyaKoJsyVlVeky2KmNIGvsaowhJpPtBL00AoH9dwzX");
    const btn = document.getElementById('checkout-button');
    btn.addEventListener('click',function(e) {
        e.preventDefault();
        // stripe.redirectToCheckout({
        //     sessionId: checkout_Id,
        //     });
        stripe.redirectToCheckout({
            sessionId:"<?php echo $checkout_session->id ?>"
        });
    });

    </script>

@endsection


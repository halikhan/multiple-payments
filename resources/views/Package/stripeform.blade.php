@extends('stripemenu')

@section('content')


    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css">
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
        </style>
    </head>

    <body>
        <section class="container">
            <div class="row white">
                <div class="block">

                    <form action="{{ route('stripe.payment')}}" method="POST" id="subscribe-form">
                        <div class="form-group">
                            <div class="row">
                                {{-- @foreach ($plans as $plan)
                                <div class="col-md-4">
                                    <div class="subscription-option">
                                        <input type="radio" id="plan-silver" name="plan" value='{{$plan->id}}'>
                                        <label for="plan-silver">
                                            <span class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                                            <span class="plan-name">{{$plan->product->name}}</span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach --}}
                            </div>
                        </div>
                        <label for="amount">Amount</label>
                        <input  name="amount" id="amount" type="number" class="form-control" placeholder="Amount" required>
                        {{-- <input value="{{$getpayment->amount}}" name="amount" id="amount" type="number" class="form-control" readonly> --}}
                        <label for="card-holder-name">Card Holder Name</label>
                        <input id="card-holder-name" type="text" class="form-control" placeholder="Card Holder Name" required>
                        @csrf
                        <div class="form-row">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element" class="form-control">
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="stripe-errors"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                        <br>
                        <div class="form-group text-center">
                            <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">SUBMIT</button>
                        </div>
                    </form>

                </div><!-- /block -->

            </div><!-- /row -->
        </section>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
    </html>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {
            hidePostalCode: true,
            style: style
        });
        card.mount('#card-element');
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        const cardHolderName = document.getElementById('card-holder-name');
        const cardHolderamount = document.getElementById('amount');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            console.log("attempting");
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );
            if (error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                paymentMethodHandler(setupIntent.payment_method);
            }
        });

        function paymentMethodHandler(payment_method) {
            var form = document.getElementById('subscribe-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', payment_method);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
@endsection

@extends('paypalmenue')

@section('content')
    <html lang="en">
    {{-- <?php
    $data['VednorReg'] = Session::get('VednorReg');
    $data['VednorLocation'] = Session::get('VednorLocation');
    $data['package_id'] = Session()->get('package_id');
    dd($data);
    ?> --}}
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css">

        <style>
            @import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic);

            body {
                background: #111d27;
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
                /* border: 1px solid #f0f0f0; */
                color: #777;
                font-size: 24px;
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
        </style>
    </head>

    <body>

        <section class="signin-section pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 pt-4 mx-auto">
                        <h1 class="forget-password-text pricing">Payment Update Details</h1>

                        <div class="col-lg-8 mx-auto mt-5 text-center">
                            <div class="paymentWrap d-flex justify-content-center">
                                <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">

                                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />
                                    <form id="regiterForm">
                                        {{ csrf_field() }}
                                        <div class="d-flex justify-content-center mt3 mb5 wow bounceIn">
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </section>



        <script
            src="https://www.paypal.com/sdk/js?client-id=Ab5PCDYtf-pseiX8jTaktOtJSuhiN5HRXxAtiZjj62yKeu0jwx0oOJzt0eOJaeu5nA8NzOzIAVj7c9LH&components=buttons&vault=true&intent=subscription">
        </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script>
            var planLocalId = '{{ $getPackage->id }}';
            var plan_id_array = [null, 'P-4TK50679J7100910FMMRDOHA', 'P-5HF49382K0325400CMMRDPRY', 'P-5AT46520GG668923XMMRDQNQ','P-8PW49365EN562770EMMRDUVA'
            ];
            paypal.Buttons({
                createSubscription: function(data, actions) {
                    return actions.subscription.create({
                        'plan_id': plan_id_array[planLocalId]
                    });
                },
                onApprove: function(data, actions) {
                    console.log(data);

                    $.ajax({
                        url: '{{ route('updatepaypal_payment') }}',
                        type: 'GET',
                        data: data,
                        success: function(data) {
                            // $("#pageloader").fadeIn();
                            if (data.status == 200) {
                                console.log(data,'payment successful');
                                swal({
                                    title: "Dear User!",
                                    text: 'You have successfully updated the plan',
                                    type: "success",
                                    icon: "success",
                                }).then(function() {
                                    location.href = "{{ route('home') }}";
                                });
                            } else {
                                swal({
                                    title: "Dear User!",
                                    text: 'Something went wrong!, Please try again',
                                    type: "error",
                                    icon: "error",
                                });

                            }


                        }

                    });
                    console.log('Transaction completed');
                }
            }).render('#paypal-button-container');
        </script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection

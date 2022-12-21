@extends('singlepaypalpaymentmenue')

@section('content')
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css">
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
            .title {
                color: #ffffff;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <section class="container">
            <h1 class="title">Single Payment</h1>
            <div class="row white">
                <div class="block">

                    @foreach ($getCMS as $key => $value)
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <ul class="pricing p-green">
                                <li>

                                    {{-- <img src="{{asset('img/stuvi-logo.png')}}" alt="logo" class="img-size-50 mr-3 img-circle"> --}}
                                    <img src="https://pngimg.com/uploads/cricket/cricket_PNG87.png" alt="" style="width:200px; height:200px;">
                                </li>
                                <li>{{ $value->details }}</li>
                                <li>Color Customization</li>
                                {{-- <li>HTML5 & CSS3</li>
                                <li>Styled elements</li> --}}
                                <li>
                                    <h3>$ {{ $value->amount }}</h3>
                                    <span>per month</span>
                                </li>
                                <li>
                                    <a href="{{ route('singlepayment.button', $value->id) }}"><button type="button"title="">
                                            Buy Now</button></a>
                                            {{-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                                <input type="hidden" name="cmd" value="{{ $value->amount }}">
                                                <input type="hidden" name="hosted_button_id" value="AVKZGVDZMEDLG">
                                                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                                </form> --}}

                                </li>
                            </ul>
                        </div>
                    @endforeach

                    {{-- $.ajax({
                        url: '{{ route('store.single.payment') }}',
                        type: 'GET',
                        data: data,
                        success: function(data) {
                            // $("#pageloader").fadeIn();
                            if (data.status == 200) {
                                console.log(data,'payment successful');
                                    setTimeout(function(){
                                    toastr.success("You have successfully purchased the plan");
                                        }, 1000)
                                location.href = "{{ route('single.payment.index') }}";
                            } else {
                                swal({
                                    title: "Dear User!",
                                    text: 'Something went wrong!, Please try again',
                                    type: "error",
                                    icon: "error",
                                });
                            }
                        }
                    }); --}}

                </div><!-- /block -->
            </div><!-- /row -->
        </section>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection

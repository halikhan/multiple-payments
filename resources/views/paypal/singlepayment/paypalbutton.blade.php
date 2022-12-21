@extends('singlepaypalpaymentmenue')

@section('content')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css">
    <title>PayPal Standard Payments Integration | Client Demo</title>
  </head>

  <body>
      <form id="regiterForm">
          {{ csrf_field() }}
          <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />
        <div class="d-flex justify-content-center mt3 mb5 wow bounceIn">
            <div id="paypal-button-container"></div>
        </div>
    </form>
    <!-- Sample PayPal credentials (client-id) are included -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>
</html>
@endsection


<script src="https://www.paypal.com/sdk/js?client-id=Ab5PCDYtf-pseiX8jTaktOtJSuhiN5HRXxAtiZjj62yKeu0jwx0oOJzt0eOJaeu5nA8NzOzIAVj7c9LH&currency=USD&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    const paypalButtonsComponent = paypal.Buttons({
        // optional styling for buttons
        // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
        style: {
            color: "gold",
            shape: "rect",
            layout: "vertical"
        },

        // set up the transaction
        createOrder: (data, actions) => {
            const createOrderPayload = {
                purchase_units: [{

                        amount: {
                            value: "{{ $getCMS->amount }}"
                        }

                    }

                ]
            };

            return actions.order.create(createOrderPayload);
        },
        onApprove: (data, actions) => {
            const captureOrderHandler = (details) => {
                const payerName = details.payer.name.given_name;
                // console.log(details);
                // alert('a');
                const TOKEN = $("#_token").val();

                $.ajax({
                    method: "POST",
                    url: "{{ route('storesingle_payment') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                      data: details,
                    // data: {
                    //     data: details,
                    // },
                    success: function(data) {
                        if (data.status == 200) {
                            console.log(data)
                            toastr.success('Your have been Successfully registered',
                                'Success');
                            setTimeout(function() {
                            }, 6000);
                            window.location.href =
                            "{{ route('single.payment.show') }}";

                        };
                    }
                });
                console.log('Transaction completed');
            };

            return actions.order.capture().then(captureOrderHandler);

            // success: function(data)
            // {
            // alert(data);
            // }
        },

        // handle unrecoverable errors
        onError: (err) => {
            console.error('An error prevented the buyer from checking out with PayPal');
        }
    });

    paypalButtonsComponent
        .render("#paypal-button-container")
        .catch((err) => {
            console.error('PayPal Buttons failed to render');
        });
</script>
@push('scripts')
<script>
    $("#regiterForm").submit(function() {
        $("#pageloader").fadeIn();
    });
</script>
@endpush

@extends('singlepaypalpaymentmenue')
@section('content')
    <style>
        .button {
            background-color: rgb(6, 144, 20);
            border: none;
            color: rgb(255, 255, 255);
            padding: 2px 7px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 26px;
        }

        .buttonold {
            background-color: rgb(74, 73, 78);
            border: none;
            color: rgb(255, 255, 255);
            padding: 2px 7px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 26px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-8">
                                <h5>Paypal-Payment Details</h5>
                            </div>
                            @if (count($errors) > 0)
                                sweetAlert("Oops...", "Something went wrong!", "error");
                            @endif
                            {{-- <div class="col-md-4" align="right">
                            <a type="button" class="btn btn-success for-font-color" href="{{ route('showpaypal.payment') }}">Go Back</a>
                                </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>Payer Name</th> --}}
                                        <th>Payment ID</th>
                                        <th>Status</th>
                                        <th>Marchant ID </th>
                                        <th>Total Amount</th>
                                        <th>Paypal Fee</th>
                                        <th>Net Amount</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        {{-- <td>{{ $key + 1 }}</td> --}}
                                        <td> {{ $response['supplementary_data']['related_ids']['order_id'] ?? '' }}</td>
                                        <td><button class="button">{{ $response['status'] ?? '' }}</button>
                                        </td>
                                        <td>{{ $response['id'] ?? '' }}</td>
                                        <td> {{ $response['seller_receivable_breakdown']['gross_amount']['value'] ?? '' }}
                                        </td>
                                        <td> {{ $response['seller_receivable_breakdown']['paypal_fee']['value'] ?? '' }}
                                        </td>
                                        <td> {{ $response['seller_receivable_breakdown']['net_amount']['value'] ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
@endsection

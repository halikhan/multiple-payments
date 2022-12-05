@extends('paypalmenue')
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
                            <a type="button" class="btn btn-primary for-font-color" href="{{ route('Package_create') }}">Create</a>
                                </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Subscriber Title</th>
                                        <th>Subscriber email</th>
                                        <th>Status</th>
                                        <th>Subscriber ID</th>
                                        {{-- <th>Plan ID</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($show_subscriptionresponse as $key => $value) --}}
                                    <tr>
                                        {{-- <td>{{ $key + 1 }}</td> --}}
                                        <td>{{ $show_subscriptionresponse['subscriber']['name']['given_name'] ?? '' }}
                                            {{ $show_subscriptionresponse['subscriber']['name']['surname'] ?? '' }}</td>
                                        <td>{{ $show_subscriptionresponse['subscriber']['email_address'] ?? '' }}</td>
                                        <td><button class="button">{{ $show_subscriptionresponse['status'] ?? '' }}</button>
                                        </td>

                                        <td>{{ $show_subscriptionresponse['id'] ?? '' }}</td>
                                        {{-- <td>{{ $show_subscriptionresponse['subscriber']['id'] ?? '' }}</td> --}}

                                        {{-- <td>{{ $value->package_id }}</td> --}}
                                    </tr>
                                    {{-- @endforeach --}}
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

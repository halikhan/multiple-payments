@extends('stripemenu')

@section('content')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">

@endsection

@section('style')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css"
        integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('breadcrumb-title')
    <h3>Package</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Package</li>
    <li class="breadcrumb-item active"> links</li>
@endsection

@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style type="text/css">
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            @if (Session::has('cancel'))
                <script type="text/javascript">
                    swal("Subscription!", "{{ Session::get('cancel') }}", "success");
                </script>
            @elseif (Session::has('resume'))
                <script type="text/javascript">
                    swal("Subscription!", "{{ Session::get('resume') }}", "success");
                </script>
            @elseif (Session::has('updated'))
                <script type="text/javascript">
                    swal("Subscription!", "{{ Session::get('updated') }}", "success");
                </script>
            @endif
            @if (session('alert-success'))
                <div class="alert alert-success" role="alert">
                    {{ session('alert-success') }}
                </div>
            @endif
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-8">
                                <h5>Show Subscription</h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            @if (count($getsubscription) > 0)
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Sub name</th>
                                            <th>Status</th>
                                            <th>Stripe Price</th>
                                            <th>Quantity</th>
                                            <th>Trial Start at</th>
                                            <th>Renew</th>
                                            <th>Payment_Refund</th>
                                            <th>Cancel</th>
                                            {{-- <th>Trial ends at</th> --}}
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($getsubscription as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->plan->name }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->stripe_status }}</td>
                                                <td>{{ $value->plan->price }}</td>
                                                <td>{{ $value->quantity }}</td>
                                                <td>
                                                    {{ date('d-M-Y  g:i A', strtotime($value->created_at)) }}
                                                </td>
                                                <td>
                                                    <!-- Rounded switch -->
                                                    <label class="switch">
                                                        @if ($value->ends_at == null)
                                                            <input type="checkbox" id="renewtoggle" checked
                                                                value="{{ $value->name }}">
                                                        @else
                                                            <input type="checkbox" id="renewtoggle"
                                                                value="{{ $value->name }}">
                                                        @endif
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" id="refund" value="{{ $value->name }}">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <button type="submit" value="{{ $value->name }}"
                                                        class="btn btn-primary" id="cancelplan">Cancel</button>
                                                </td>
                                                {{-- <td>{{ $value->trial_ends_at }}</td> --}}
                                                {{-- <td>
                                            <a  href="{{ route('Package_destroy', $value->id) }}" id="delete"><button class="btn btn-danger btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title="">Delete</button></a>
                                            <a href="{{ route('Package_edit', $value->id) }}"><button class="btn btn-success btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title=""> Edit</button></a>
                                         </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <h4>no subscriptions</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            // alert('Please wait...');
            var subscriptioname = $('#renewtoggle').val();
            console.log(subscriptioname)
            $('#renewtoggle').click(function() {
                if ($(this).is(':checked')) {
                    console.log('checked');
                    $.ajax({
                        url: '{{ route('subscriptions.resume') }}',
                        data: {
                            subscriptioname
                        },
                        type: "GET",
                        success: function(resumesubs) {
                            Swal.fire(
                                'Subscription!',
                                'You have Successfully Resumed Subscription!',
                                'success'
                            )
                        },
                        error: function(response) {}
                    });

                } else {
                    console.log('not checked');
                    $.ajax({
                        url: '{{ route('cancel.user.subscription') }}',
                        type: 'GET',
                        data: {
                            subscriptioname
                        },
                        success: function(data) {
                            Swal.fire(
                                'Subscription!',
                                'You have Successfully Cancelled Subscription!',
                                'success'
                            )
                        },
                        error: function(data) {
                            // console.log(data);
                        }
                    });
                    // console.log('is not checked');
                }
            });
        });

        $('#refund').on('click', function() {
            // alert('test');
            var subscriptionName = $('#refund').val();
            // alert(subscriptionName);
            if ($(this).is(':checked')) {
                $.ajax({
                    url: '{{ route("subscriptions.refund") }}',
                    data: {
                        subscriptionName
                    },
                    type: "GET",
                    success: function(RefundPayments) {
                        Swal.fire(
                            'Subscription!',
                            'You have Successfully Refund Payments!',
                            'success'
                        )
                    },
                    error: function(response) {
                        // console.log(response);
                        Swal.fire(
                            'Subscription!',
                            'Charge has already been refunded!',
                            'info'
                        )
                    }
                });
            }

        });
        $('#cancelplan').on('click',function() {
            // alert('test');
            var subscriptionName = $('#cancelplan').val();
            // alert(subscriptionName);
                $.ajax({
                    url:'{{ route("cancelplan") }}',
                    data: { subscriptionName },
                    type:"GET",
                    success:function(response)
                    {
                        Swal.fire(
                            'Subscription!',
                            'You have Successfully Cancelled Subscription!',
                            'success'
                            )
                    },
                    error: function(response)
                    {
                        // console.log(response);
                        Swal.fire(
                             'Subscription!',
                             'Subscription already has been Cancelled!',
                             'info'
                        )
                    }
                });
        });
    </script>

@endsection

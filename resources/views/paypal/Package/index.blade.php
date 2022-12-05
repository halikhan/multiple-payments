@extends('paypalmenue')
@section('content')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('breadcrumb-title')
    <h3>Package</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Package</li>
    <li class="breadcrumb-item active"> links</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-8">
                                <h5>Packages</h5>
                            </div>
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
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>Package</th>
                                           {{-- <th>Suspend</th> --}}
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($getCMS as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->amount }}</td>
                                            <td>{{ $value->type }}</td>
                                            <td>{{ $value->details }}</td>
                                           <td>
                                                <form class="form theme-form"id="" action="{{ route('paypal.package.payment.update', $value->id ??'') }}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                  <button class="btn btn-info" type="submit"> Update</button>
                                                </form>
                                            </td>
                                             {{-- <td>
                                                <form class="form theme-form"id="" action="{{ route('package.paymentSuspend', $value->id ??'') }}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                  <button class="btn btn-info" type="submit"> Suspend</button>
                                                </form>
                                            </td> --}}
                                            <td>
                                                {{-- <a  href="{{ route('Package_destroy', $value->id) }}" id="delete"><button class="btn btn-danger btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title="">Delete</button></a> --}}

                                                {{-- <a href="{{ route('package.paymentupdate', $value->id) }}"><button class="btn btn-info btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title="">Update</button></a> --}}

                                                <a href="{{ route('paypal.packages.edit', $value->id) }}"><button class="btn btn-success btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title=""> Edit</button></a>

                                             </td>
                                        </tr>
                                    @endforeach
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
        $(document).ready(function () {
        $('#example').DataTable();
    });
        </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
@endsection

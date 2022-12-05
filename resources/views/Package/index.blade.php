@extends('stripemenu')
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
                                <h5>Package</h5>
                            </div>
                            <div class="col-md-4" align="right">
                                <a type="button" class="btn btn-primary for-font-color" href="{{ route('Package_create') }}">Create</a>
                            </div>
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
                                        <th>Name</th>
                                        <th>Currency</th>
                                        <th>Plan ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($getCMS as $key => $value)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->price }}</td>
                                            <td>{{ $value->billing_payment }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->currency }}</td>
                                            <td>{{ $value->plan_id }}</td>
                                            <td>
                                                <a  href="{{ route('Package_destroy', $value->id) }}" id="delete"><button class="btn btn-danger btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title="">Delete</button></a>
                                                {{-- <a href="{{ route('Package_edit', $value->id) }}"><button class="btn btn-success btn-xs for-font-color" type="button" data-original-title="btn btn-danger btn-xs" title=""> Edit</button></a> --}}
                                             </td>
                                        </tr>
                                        @empty
                                        <div>
                                            <h5>No any package available</h5>
                                        </div>
                                        @endforelse
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

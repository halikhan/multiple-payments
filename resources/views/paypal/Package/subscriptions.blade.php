@extends('paypalmenue')
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
{{-- <script> toastr.success("s");</script> --}}
<style>
    .buttonstatus {
  background-color: rgb(2, 100, 17);
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
.buttonUpdated {
  background-color: rgb(250, 7, 7);
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
                                        <th>User Name</th>
                                        <th>Amount</th>
                                        <th>Package Type</th>
                                        <th>Package Details</th>
                                        <th>Status</th>
                                        <th>Details </th>
                                        {{-- <th>Update & Details </th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getCMS as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->name ?? '' }}</td>
                                            <td>{{ $value->package_amount ?? '' }}</td>
                                            <td>{{ $value->PackageDetails->type ?? '' }}</td>
                                            <td>{{ $value->PackageDetails->details ?? '' }}</td>
                                            <td>
                                                @if ($value->status == 0)
                                                <button class="buttonstatus"> Active</button>
                                                @else
                                                <button class="buttonUpdated">Canceled</button>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('subcription.updatepaypal', $value->package_id ?? '') }}"><button
                                                        class="btn btn-success btn-xs for-font-color" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title="">
                                                        Update</button>
                                                    </a> --}}

                                                <a href="{{ route('showpaypal.payment', $value->package_id ?? '') }}"><button class="btn btn-primary" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title="">
                                                        Show</button></a>
                                            </td>
                                            <td>

                                                    @if ($value->status == 0)
                                                    <form class="form theme-form"id=""
                                                    action="{{ route('cancel.paypal.payment', $value->package_id ?? '') }}"
                                                    enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit"> Cancel</button>
                                                    </form>
                                                    @else
                                                    <form class="form theme-form"id=""
                                                    action="{{ route('paypal.reactive.payment', $value->package_id ?? '') }}"
                                                    enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    <button class="btn btn-info" type="submit"> Re-Active</button>
                                                    </form>
                                                    @endif

                                            </td>
                                            {{-- <td>
                                                <form class="form theme-form"id="" action="{{ route('reactive.payment', $value->package_id ??'') }}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                  <button class="btn btn-success" type="submit"> ReActive</button>
                                                </form>
                                            </td> --}}
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
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
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

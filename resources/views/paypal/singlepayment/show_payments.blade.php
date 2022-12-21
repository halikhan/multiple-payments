@extends('singlepaypalpaymentmenue')
@section('content')
<style>


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
    #loader-gif {
  display: none;
 }
</style>
@if (session()->has('success'))
<script>
    toastr.success("{!! session()->get('success')!!}");
</script>
@endif
@if(Session::has('message'))
    toastr.info("{{ Session::get('message') }}");
@endif
@if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <div class="container-fluid">
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <div class="row">
            <img id="loader-gif" src="https://cdn.dribbble.com/users/68398/screenshots/3687284/loader_800.gif" alt="" />
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-8">
                                <h5>Payments</h5>
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
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Payment id</th>
                                        <th>Details</th>
                                        <th>Refund</th>
                                        <th>Refunded Details</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($getCMS as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->package_amount }}</td>
                                            <td>{{ $value->payment_id }}</td>

                                            <td>
                                                <form class="form theme-form"
                                                action="{{ route('single.paypal.packages.show', $value->payment_id) }}"
                                                enctype="multipart/form-data" method="post">
                                                @csrf
                                         <button class="btn btn-primary " type="submit" id="dejangoshow"> Show</button>
                                                </form>
                                             </td>
                                             <td>
                                                @if ($value->status == 0)
                                                <form class="form theme-form"
                                                action="{{ route('single.paypal.packages.refund', $value->payment_id) }}"
                                                enctype="multipart/form-data" method="post">
                                                @csrf
                                                <button class="btn btn-info dejango" onclick="AmagiLoader" type="submit">Refund</button>
                                                </form>
                                                @else
                                                <button class="buttonold">Refunded</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($value->status == 0)
                                                <a href="{{ route('single.paypal.packages.showRefund', $value->payment_id) }}"class="btn btn-success dejango" onclick="AmagiLoader"> Refunded Details</a>
                                                @else
                                                <button class="buttonold">Not Refunded</button>
                                                @endif
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

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script>
$("#dejangoshow").submit(function() {
  $("#loader-gif").show();
  setTimeout(function() {
    $("#loader-gif").hide();
  }, 5000);
});

 $('#').click(function(){
    AmagiLoader.show();
 setTimeout(() => {
    AmagiLoader.hide();
 }, 1000);
});
</script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
@endsection


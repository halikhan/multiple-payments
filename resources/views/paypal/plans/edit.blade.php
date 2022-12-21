@extends('paypalplanspayment')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Plan</h5>
            </div>
            {{-- {{ route("plans.store") }} --}}
                <form class="form theme-form"id="" action="{{ route("plans.updateprice") }}" enctype="multipart/form-data" method="post">
                    @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Product ID.*</label>
                                <input name="product_id" class="form-control btn-square" value="{{ $getPaypalProduct->product_id }}"  id="exampleFormControlInput10" type="text" placeholder="PROD-XXCD1234QWER65782" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Plan ID.*</label>
                                <input name="plan_id" class="form-control btn-square" value="{{ $getPaypalProduct->plan_id }}"  id="exampleFormControlInput10" type="text" placeholder="PROD-XXCD1234QWER65782" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Plan Name.*</label>
                                <input name="name" class="form-control btn-square" value="{{ $getPaypalProduct->name}}"  id="exampleFormControlInput10" type="text" placeholder="Video Streaming Service Plan" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Short Description.*</label>
                                <input name="description" class="form-control btn-square" value="{{ $getPaypalProduct->description}}"  id="exampleFormControlInput10" type="text" placeholder="Video Streaming Service basic plan" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Price.*</label>
                                <input name="fixed_price" class="form-control btn-square"  id="exampleFormControlInput10" type="number" value="{{ $getPaypalProduct->plan_price}}" placeholder="Price" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Currency.*</label>
                                <input name="currency_code" value="usd" class="form-control btn-square"  id="exampleFormControlInput10" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput10">Interval Count.*</label>
                                <input name="interval_count" class="form-control btn-square"  value="{{ $getPaypalProduct->interval_count}}"" maxlength="2" type="text" placeholder="Interval Count" readonly>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Billing Period.*</label>

                                <input name="interval_unit" class="form-control btn-square"  id="exampleFormControlInput10" maxlength="2" type="text" placeholder="Interval Count" value="{{ $getPaypalProduct->billing_cycles_period}}" readonly>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    {{-- <input class="btn btn-light" type="reset" value="Cancel"> --}}
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>

@if($errors->any())

@foreach($errors->all() as $error)
<script>
    toastr.error('{{$error}}');
</script>
@endforeach
@endif
@endsection

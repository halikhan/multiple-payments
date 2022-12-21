@extends('paypalplanspayment')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            <h5>Edit Product</h5>
        </div>
        {{-- {{ route("Package_store") }} --}}
            <form class="form theme-form"id="" action="{{ route("plans.update",$productdata->id ??'') }}" enctype="multipart/form-data" method="post">
                @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlInput10">Plan Name.*</label>
                            <input name="name" class="form-control btn-square" value="{{ $productdata->name }}"  id="exampleFormControlInput10" type="text" placeholder="Video Streaming Service Plan" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlInput10">Short Description.*</label>
                            <input name="description" class="form-control btn-square" value="{{ $productdata->description }}"  id="exampleFormControlInput10" type="text" placeholder="Video Streaming Service basic plan">
                        </div>
                    </div>
                </div>

            </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
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

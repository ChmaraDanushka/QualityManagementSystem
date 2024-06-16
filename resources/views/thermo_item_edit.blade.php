@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row"  id="title_bar">


<main class="container">
<div class="col" id="form_title">
<div class="col col-sm-3 col-xs-12">
                            <h6 class="title" style="margin-left:1px">Edit Thermo Forming Products</h6>

                        </div>
                        </div>
    <form action="{{ route('thermo_item_edit') }}" method="POST" class="modern-form" id="add_admin_form" enctype="multipart/form-data">
    {{ @csrf_field() }}
    {{@method_field('PUT')}}

{{-- Success and Error Messages --}}
@if (Session::has('success'))
<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
@endif
<input type="hidden"   name="thermo_items_id" value="{{$data->thermo_items_id}}">
<div class="row">
<h7>Item Data</h7>
<hr>
    <div class="col">
    <div class="form-group">
        <label for="item">Item Discription (PP 350ml Clear Tub)</label>
          <input id="output"  name="item" type="text" class="form-control form-control-sm"  value="{{$data->thermo_items_name}}">
          <span class="text-danger">@error('item') {{ $message }} @enderror</span>
        </div>
    </div>
    <div class="col">
    <div class="form-group">
        <label for="color">Color Of the Product</label>
        <select class="form-select"  name="color" id="input2">
                         <option selected value="{{$data->thermo_items_color}}">{{$data->thermo_items_color}}</option>
                         <option value="Black">Black</option>
                         <option value="Clear">clear</option>
                         <option value="White">White</option>
                         <option value="Semi">Semi</option>
                         <option value="Brown">Brown</option>
                         <option value="Gold">Gold</option>          
         </select>
          <span class="text-danger">@error('color') {{ $message }} @enderror</span>
        </div>
    </div>
    <div class="col">
    <div class="form-group">
        <label for="top">Material Type (PP / HIPS)</label>
        <select class="form-select"  name="material" id="input2">
                         <option selected value="{{$data->thermo_items_mt}}">{{$data->thermo_items_mt}}</option>
                         <option value="PP">PP</option>
                         <option value="HIPS">HIPS</option>        
         </select>
          <span class="text-danger">@error('top') {{ $message }} @enderror</span>
        </div>
    </div>
  </div>
    <div class="row">
      <div class="col-md-6">
        
        <h7>Diameters (mm)</h7>
      <hr>
        <div class="form-group">
        <label for="top">Top (EX 74.5 +- 2)</label>
          <input id="output"  name="top" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_top}}">
          <span class="text-danger">@error('top') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
        <label for="outside">Outside (EX 74.5 +- 2)</label>
          <input id="output"  name="outside" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_outside}}">
          <span class="text-danger">@error('outside') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
          <label for="bottom">Bottom (EX 74.5 +- 2)</label>
          <input id="output"  name="bottom" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_bottom}}">
          <span class="text-danger">@error('bottom') {{ $message }} @enderror</span>
        </div>
  
     
      </div>
      <div class="col-md-6">
      <h7>Thicknesses (mm)</h7>
      <hr>
      <div class="form-group">
          <label for="brim">Brim (EX 0.55 +- 2)</label>
          <input id="brand" name="brim" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_brim}}">
          <span class="text-danger">@error('brim') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="body">Body (EX 0.20 +- 2)</label>
          <input id="grade" name="body" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_body}}">
          <span class="text-danger">@error('body') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="base">Base (EX 0.28 +- 2)</label>
          <input id="output"  name="base" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_base}}">
          <span class="text-danger">@error('base') {{ $message }} @enderror</span>
        </div>

    </div>
    <div class="col-md-6">
    <h7>Other Details</h7>
     <hr>
     <div class="form-group">
         <label for="height">Height(mm) (56.5 -+ 2)</label>
         <input id="brand" name="height" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_height}}">
         <span class="text-danger">@error('height') {{ $message }} @enderror</span>
       </div>
       <div class="form-group">
         <label for="weight">Weight (mm) (EX 18.5 +- 2)</label>
         <input id="grade" name="weight" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_weight}}">
         <span class="text-danger">@error('weight') {{ $message }} @enderror</span>
       </div>

   </div>
   <div class="col-md-6">
    <h7></h7><br>
     <hr>
     <div class="form-group">
         <label for="capacity">Capacity (ml) (EX 80ml)</label>
         <input id="brand" name="capacity" type="text" class="form-control form-control-sm"  value="{{$data->thermo_item_capacity}}">
         <span class="text-danger">@error('capacity') {{ $message }} @enderror</span>
       </div>


   </div>

    <div class="text-right">
      <button type="submit" class="btn btn-primary">Update</button>
      <button type="button" class="btn btn-secondary" onclick="redirectToClose()">Close</button>

<script>
    function redirectToClose() {
        // Replace 'your-route-name' with the actual name or URL of the route you want to redirect to
        var routeUrl = "{{ url('thermo_product_add') }}";
        window.location.href = routeUrl;
    }
</script>

    </div>
  </form>
  </div>
  @endsection
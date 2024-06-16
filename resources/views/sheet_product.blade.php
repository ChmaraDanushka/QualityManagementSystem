@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row"  id="title_bar">


<main class="container">
<div class="col" id="form_title">
<div class="col col-sm-3 col-xs-12">
                            <h6 class="title">Add Sheet Products<span></span></h6>

                        </div>
                        </div>
  <form action="{{ route('sheet_product') }}" method="POST" class="modern-form" id="add_admin_form" action="/upload" enctype="multipart/form-data">
  @csrf

{{-- Success and Error Messages --}}
@if (Session::has('success'))
<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
@endif
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="sheet_type">Type Of Sheet</label>

          <select class="form-select" name="sheet_type" id="input1" type="text">
                           <option selected disabled>Select type...</option>
                           <option value="HIPS">HIPS</option>
                           <option value="PP">PP</option> 
         </select>
         <span class="text-danger">@error('sheet_type') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
          <label for="sheet_color">Sheet Color</label>
          <select class="form-select"  name="sheet_color" id="input2" type="text">
                         <option selected>select type....</option>
                         <option value="Black">Black</option>
                         <option value="White">White</option>
                         <option value="Semi">Semi</option>
                         <option value="Brown">Brown</option>
                         <option value="Gold">Gold</option>          
         </select>
         <span class="text-danger">@error('sheet_color') {{ $message }} @enderror</span>
        </div>

        <!-- <div class="form-group">
          <label for="batch_no">Batch No</label>
          <input id="output"  name="batch_no" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('batch_no') {{ $message }} @enderror</span>
        </div> -->
  
     
      </div>
      <div class="col-md-6">
     
      <div class="form-group">
          <label for="standard_width">Standard Width (Inch/CM) EX Inch = 20.33 / CM = 650</label>
          <input id="brand" name="standard_width" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('standard_width') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="standard_thickness">Standard Thickness (mm) EX 0.60 / 1.18</label>
          <input id="grade" name="standard_thickness" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('standard_thickness') {{ $message }} @enderror</span>
        </div>

    </div>

    <div class="text-right">
      <button type="submit" class="btn btn-primary">Add</button>
      <button type="reset" class="btn btn-secondary">Clear</button>
    </div>
  </form>
  </div>



<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

    <div class="row d-none">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-sm-3 col-xs-12">
                            <h4 class="title">Data <span>List</span></h4>
                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group">
                                <input type="text" class="form-control form-control-sm" placeholder="Search">
                                <button class="btn btn-default" title="Reload"><i class="fa fa-sync-alt"></i></button>
                                <button class="btn btn-default" title="Pdf"><i class="fa fa-file-pdf"></i></button>
                                <button class="btn btn-default" title="Excel"><i class="fas fa-file-excel"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type of Sheet</th>
                                <th>Sheet Colour</th>
                                <!-- <th>Batch No</th> -->
                                <th>Standerd Width</th>
                                <th>Standerd Thikness</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($admin as $key=>$admin)
                            <tr> 
                                <td>{{$key+1}}</td>
                                <td>{{$admin['s_type']}}</td>
                                <td>{{$admin['s_color']}}</td>
                                <!-- <td>{{$admin['s_batchNo']}}</td> -->
                                <td>{{$admin['s_width']}}</td>
                                <td>{{$admin['s_thickness']}}</td>
                                <td>  <a href="{{ "delete_sheet_product/".$admin['s_product_id'] }}" class="btn btn-outline-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a></td>
                         
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- <div class="panel-footer">
                    <div class="row">
                        <div class="col col-sm-6 col-xs-6">showing <b>5</b> out of <b>25</b> entries</div>
                        <div class="col-sm-6 col-xs-6">
                            <ul class="pagination hidden-xs pull-right">
                                <li><a href="#"><</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">></a></li>
                            </ul>
                            <ul class="pagination visible-xs pull-right">
                                <li><a href="#"><</a></li>
                                <li><a href="#">></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            </main>
        </div>
    </div>
</div>


@endsection
<script>
// function updateOutput() {
//   // Get the values from the first and second input fields
//   var value1 = document.getElementById("input1").value;
//   var value2 = document.getElementById("input2").value;

//   // Get the first letters of the values
//   var firstLetter1 = value1.charAt(0);
//   var firstLetter2 = value2.charAt(0);

//   // Combine the first letters and set them in the output field
//   var output = document.getElementById("output");
//   output.value = firstLetter1 + firstLetter2;
// }

</script>

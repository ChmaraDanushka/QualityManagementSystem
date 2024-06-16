@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row"  id="title_bar">


<main class="container">
<div class="col" id="form_title">
<div class="col col-sm-3 col-xs-12">
                            <h6 class="title" style="margin-left:5px">Add Thermo Forming Products</h6>

                        </div>
                        </div>
  <form action="{{ route('thermo_product_add') }}" method="POST" class="modern-form" id="add_admin_form"  enctype="multipart/form-data">
  @csrf

{{-- Success and Error Messages --}}
@if (Session::has('success'))
<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
@endif
<div class="row">
<h7>Item Data</h7>
<hr>
    <div class="col">
    <div class="form-group">
        <label for="item">Item Discription (PP 350ml Clear Tub)</label>
          <input id="output"  name="item" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('item') {{ $message }} @enderror</span>
        </div>
    </div>
    <div class="col">
    <div class="form-group">
        <label for="color">Color Of the Product</label>
        <select class="form-select"  name="color" id="input2">
                         <option selected>select type....</option>
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
                         <option selected>select type....</option>
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
          <input id="output"  name="top" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('top') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
        <label for="outside">Outside (EX 74.5 +- 2)</label>
          <input id="output"  name="outside" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('outside') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
          <label for="bottom">Bottom (EX 74.5 +- 2)</label>
          <input id="output"  name="bottom" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('bottom') {{ $message }} @enderror</span>
        </div>
  
     
      </div>
      <div class="col-md-6">
      <h7>Thicknesses (mm)</h7>
      <hr>
      <div class="form-group">
          <label for="brim">Brim (EX 0.55 +- 2)</label>
          <input id="brand" name="brim" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('brim') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="body">Body (EX 0.20 +- 2)</label>
          <input id="grade" name="body" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('body') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="base">Base (EX 0.28 +- 2)</label>
          <input id="output"  name="base" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('base') {{ $message }} @enderror</span>
        </div>

    </div>
    <div class="col-md-6">
    <h7>Other Details</h7>
     <hr>
     <div class="form-group">
         <label for="height">Height(mm) (56.5 -+ 2)</label>
         <input id="brand" name="height" type="text" class="form-control form-control-sm" />
         <span class="text-danger">@error('height') {{ $message }} @enderror</span>
       </div>
       <div class="form-group">
         <label for="weight">Weight (mm) (EX 18.5 +- 2)</label>
         <input id="grade" name="weight" type="text" class="form-control form-control-sm" />
         <span class="text-danger">@error('weight') {{ $message }} @enderror</span>
       </div>

   </div>
   <div class="col-md-6">
    <h7></h7><br>
     <hr>
     <div class="form-group">
         <label for="capacity">Capacity (ml) (EX 80ml)</label>
         <input id="brand" name="capacity" type="text" class="form-control form-control-sm" />
         <span class="text-danger">@error('capacity') {{ $message }} @enderror</span>
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
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search">
                                <button class="btn btn-default" title="Reload"><i class="fa fa-sync-alt"></i></button>
                                <button class="btn btn-default" title="Pdf"><i class="fa fa-file-pdf"></i></button>
                                <button class="btn btn-default" title="PDF" id="downloadPDF"><i class="fa fa-file-pdf"></i></button>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add click event to the PDF button to open the print view for the table -->
<script>
$(document).ready(function() {
    // Add click event to the PDF button
    $("#downloadPDF").click(function() {
        // Open the print view for the table
        window.print();
    });
});
</script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Item</th>
                                <th>Material</th>
                                <th>Top Diameter (mm)</th>
                                <th>Outside Diameter (mm)</th>
                                <th>Bottom Diameter (mm)</th>
                                <th>Bottom Diameter (mm)</th>
                                <th>Brim (mm)</th>
                                <th>Body (mm)</th>
                                <th>Base (mm)</th>
                                <th>Height(mm)</th>
                                <th>Weight(mm)</th>
                                <th>Capacity(mm)</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($admin as $admin)
                            <tr style="border-bottom-width: 1px;">
                                <td>
                                <a href="{{ "delete_thermo_pr/".$admin['thermo_items_id'] }}" class="btn btn-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a>
</td>
<td>
                                <a href="{{ "edit_thermo_pr/".$admin['thermo_items_id'] }}" class="btn btn-success btn-sm" >Edit</a>
                                </td>
                                <td>{{$admin['thermo_items_name']}}</td>
                                <td>{{$admin['thermo_items_color']}}</td>
                                <td>{{$admin['thermo_items_mt']}}</td>
                                <td>{{$admin['thermo_item_top']}}</td>
                                <td>{{$admin['thermo_item_outside']}}</td>
                                <td>{{$admin['thermo_item_bottom']}}</td>
                                <td>{{$admin['thermo_item_brim']}}</td>
                                <td>{{$admin['thermo_item_body']}}</td>
                                <td>{{$admin['thermo_item_base']}}</td>
                                <td>{{$admin['thermo_item_height']}}</td>
                                <td>{{$admin['thermo_item_weight']}}</td>
                                <td>{{$admin['thermo_item_capacity']}}</td>
                         
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
<script>
  function styledConfirm(message) {
    if (confirm(message)) {
      // User clicked OK
      return true;
    } else {
      // User clicked Cancel
      return false;
    }
  }

  function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // Change index based on the column you want to filter
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Attach the filter function to the input event
    document.getElementById("searchInput").addEventListener("input", filterTable);
</script>

@endsection


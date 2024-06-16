@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row"  id="title_bar">

<hr>
<main class="container">
<div class="col" id="form_title">
<div class="col col-sm-3 col-xs-12">
                            <h6 class="title">Add Sheet Materials<span></span></h6>

                        </div>
                        </div>
  <form action="{{ route('sheet_material_add') }}" method="POST" class="modern-form" id="add_admin_form" action="/upload" enctype="multipart/form-data">
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
          <label for="name">Material Name</label>
          <input id="material_name" name="material_name" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('material_name') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="supplier">Supplier</label>
          <input id="email" name="supplier" type="text" class="form-control form-control-sm" />
       
        </div>
        <div class="form-group">
          <label for="batch_no">Batch No</label>
          <input id="email" name="batch_no" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('batch_no') {{ $message }} @enderror</span>
          
        </div>
  
     
      </div>
      <div class="col-md-6">
     
      <div class="form-group">
          <label for="brand">Brand</label>
          <input id="brand" name="brand" type="text" class="form-control form-control-sm" />
        </div>
        <div class="form-group">
          <label for="grade">Grade</label>
          <input id="grade" name="grade" type="text" class="form-control form-control-sm" />
          <span class="text-danger">@error('grade') {{ $message }} @enderror</span>
        </div>

    </div>

    <div class="text-right">
      <button type="submit" class="btn btn-primary">Add</button>
      <button type="reset" class="btn btn-secondary">Clear</button>
    </div>
  </form>




<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

    <div class="row">
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
                                <button class="btn btn-default" title="Excel"><i class="fas fa-file-excel"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                <table class="table" id="myTable">
                        <thead>
                            <tr>
                            <th></th>
                              
                               
                                <th>Material Name</th>
                                <th>Supplier</th>
                                <th>Batch No</th>
                                <th>Brand</th>
                                <th>Grade</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($admin as $admin)
                            <tr>
                                <td>
                        <a href="{{ "delete_material/".$admin['material_id'] }}" class="btn btn-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a>
                               </td>
                                <td>{{$admin['sheet_material_name']}}</td>
                                <td>{{$admin['sheet_material_supplier']}}</td>
                                <td>{{$admin['sheet_material_batch_no']}}</td>
                                <td>{{$admin['sheet_material_brand']}}</td>
                                <td>{{$admin['sheet_material_grade']}}</td>
                               
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
            td = tr[i].getElementsByTagName("td")[1]; // Change index based on the column you want to filter
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

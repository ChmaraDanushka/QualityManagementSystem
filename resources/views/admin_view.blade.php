@extends('admin_layout')

@section('admincontent')



<link href="{{asset('/css/qc-table.css')}}" rel="stylesheet">
<style>
    /* Style for the popup container */
    .popup-container {
      position: relative;
      display: inline-block;
    }

    /* Style for the popup image */
    .popup-image {
      display: none;
      position: absolute;
      top: -90%;
      left: 0;
      z-index: 1;
      max-width: 300px; /* Adjust the maximum width as needed */
    }

    /* Show the popup image on hover */
    .popup-container:hover .popup-image {
      display: block;
    }
  </style>

<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-sm-3 col-xs-12">
                            <h5 class="title">Admin List <span></span></h5>
                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group">
                                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search">
                                <button class="btn btn-default" title="Reload"><i class="fa fa-sync-alt"></i></button>
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
                    <th></th>
                    <th>User ID</th>
                    <th>Reg No</th>
                    <th>Profile pic</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>TP</th>
                    <th>User Level</th>
               
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $admin)
                <tr>
                <td>
                        <a href="{{ "edit_admin/".$admin['user_id'] }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                        <a href="{{ "delete_admin/".$admin['user_id'] }}" class="btn btn-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a>

                       
                    </td>
                    <td>{{$admin['user_id']}}</td>
                    <td>{{$admin['user_reg_no']}}</td>
                    <td>
                    <div class="popup-container">
  <img src="{{ asset('uploads/admin_pro/' . $admin['user_profile_picture']) }}" alt="Image" title="Image Title" style="max-width: 50%; height: auto;">
  <div class="popup-image">
    <img src="{{ asset('uploads/admin_pro/' . $admin['user_profile_picture']) }}" alt="Image" title="Image Title" style="max-width: 100%; height: auto;">
  </div>
</div>







                    </td>
                    <td>{{$admin['user_first_name']}} {{$admin['user_last_name']}}</td>
                    <td>{{$admin['user_nic']}}</td>
                    <td>{{$admin['user_address']}}</td>
                    <td>{{$admin['user_email']}}</td>
                    <td>{{$admin['user_tp']}}</td>
                    <td>{{$admin['user_level']}}</td>
         
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



<!-- Include jQuery -->




    
</script>

@endsection

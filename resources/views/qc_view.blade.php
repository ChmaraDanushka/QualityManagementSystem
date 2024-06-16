@extends('admin_layout')

@section('admincontent')



<link href="{{asset('/css/mytable.css')}}" rel="stylesheet">

<link href="{{asset('/css/qc-table.css')}}" rel="stylesheet">
<style>
    .panel{
    margin-top:10px;
  }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-sm-3 col-xs-12">
                            <h5 class="title"><span>Qc List View</span></h5>
                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group">
                                <input type="text" class="form-control form-control-sm" placeholder="Search">
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
                    <table class="table">
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
         
               
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $admin)
                <tr>
                <td>
                        <a href="{{ "qc_update/".$admin['qc_id'] }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                        <a href="{{ "delete_qc/".$admin['qc_id'] }}" class="btn btn-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a>

                       
                    </td>
                    <td>{{$admin['qc_id']}}</td>
                    <td>{{$admin['qc_reg_no']}}</td>
                    <td>{{$admin['qc_profile_picture']}}
                    <img src="{{ asset('uploads/admin_pro/' . $admin['qc_pro_pic']) }}" alt="Image" title="Image Title" style=" max-width: 100%;height: auto;">



                    </td>
                    <td>{{$admin['qc_first_name']}} {{$admin['qc_last_name']}}</td>
                    <td>{{$admin['qc_nic']}}</td>
                    <td>{{$admin['qc_address']}}</td>
                    <td>{{$admin['qc_email']}}</td>
                    <td>{{$admin['qc_tp']}}</td>
             
         
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
</script>
@endsection

@extends('admin_layout')

@section('admincontent')

<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold">Sheet Extruder Ongoing Checklist<span></span></h4>

            </div>
        </div>


        <!-----------------------------------Mixcher add------------------------------------------------>





        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel">
                    
                    <div class="panel-body table-responsive pt-3">

                        <table class="table" id="qualityongoing">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Checked By</th>
                                    <th>M/C No</th>
                                    <th>Material Type</th>
                                    <th> Standard Color </th>
                                    <!-- <th> Batch No </th> -->
                                    <th> Standard Width </th>
                                    <th> Standard Thicknes </th>
                                    <th> Time </th>
                                    <th> Date </th>
                                    <th> Roll batch No </th>
                                    <th> Roll width </th>
                                    <th> Contaminations Or Dust </th>
                                    <th> Right Thickness </th>
                                    <th> Middle right Thickness</th>
                                    <th> Middle left Thickness </th>
                                    <th> left Thickness </th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $admin)
                                <tr>
                                <td class="fw-bold {{$admin['sheet_issues']==0?'text-success':'text-danger' }}"><i class="fa {{$admin['sheet_issues']==0?'fa-check-circle text-success':'fa-exclamation-triangle text-danger' }}"></i> {{$admin['sheet_issues']==0?'Q':$admin['sheet_issues'] }}</td>
                                    <td>{{$admin['qc_first_name']}}</td>
                                    <td>{{$admin['sheet_chc_mc']}}</td>
                                    <td>{{$admin['sheet_chc_mt']}}</td>
                                    <td>{{$admin['sheet_chc_color']}}</td>
                                    <!-- <td>{{$admin['sheet_chc_batch']}}</td> -->
                                    <td>{{$admin['sheet_chc_width']}}</td>
                                    <td>{{$admin['sheet_chc_thickness']}}</td>
                                    <td>{{$admin['sheet_chc_time']}}</td>
                                    <td>{{$admin['sheet_chc_date']}}</td>
                                    <td>{{$admin['sheet_chc_rollBatch']}}</td>
                                    <td>{{$admin['sheet_chc_rollWidth']}}</td>
                                    <td>{{$admin['sheet_chc_roll_dust']}}</td>
                                    <td>{{$admin['sheet_chc_roll_r']}}</td>
                                    <td>{{$admin['sheet_chc_roll_mr']}}</td>
                                    <td>{{$admin['sheet_chc_roll_ml']}}</td>
                                    <td>{{$admin['sheet_chc_roll_l']}}</td>
                                    <td>
                                        <a href="{{ "delete_sheet_all_ch/".$admin['sheet_chc_id'] }}" class="btn btn-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this Record?')">Delete</a>
                                    </td>



                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

<script>
    //get date
    // Select the input field by its ID
    var dateInput = document.getElementById('ch_date'); // Replace 'yourInputId' with the actual ID of your input field

    // Create a new Date object representing the current date
    var currentDate = new Date();

    // Format the date to YYYY-MM-DD (the format expected by the 'date' input type)
    var formattedDate = currentDate.toISOString().split('T')[0];

    // Set the value of the input field to the formatted date
    dateInput.value = formattedDate;

    //get time 
    function getCurrentTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    // Function to set the current time to the input field
    function setCurrentTime() {
        const timeInput = document.getElementById('ch_time');
        if (timeInput) {
            timeInput.value = getCurrentTime();
        }
    }

    // Call the function to set the initial time
    setCurrentTime();
</script>



@endsection

@section('page-scripts')
<script>
    $(document).ready(function(){
      
      var table = $('#qualityongoing').DataTable({
          "sDom": 'Rfrtlip',
          "order": [ ],
      });
    });
</script>
@endsection
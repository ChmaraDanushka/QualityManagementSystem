@extends('admin_layout')

@section('admincontent')

<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold">Thermo Form ongoing check list History<span></span></h4>

            </div>
        </div>


        <!-----------------------------------Mixcher add------------------------------------------------>





        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel">

                    
                    <div class="panel-body table-responsive pt-3">

                    <table class="table" id="thermolist">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>M/C No</th>
                                    <th> Item Name </th>
                                    <th>Material Type</th>
                                    <th> Standard Color </th>
                                    <th> Created At </th>                           
                                    <th> Hight </th>
                                    <th> Top </th>
                                    <th> Outer </th>
                                    <th> Bottom </th>
                                    <th> Brim </th>
                                    <th> Body </th>
                                    <th> Base</th>
                                    <th> Width </th>
                                    <th> Volume </th> 
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($th_list as $th)
                                <tr>
                                <td class="fw-bold {{$th->thermo_issues==0?'text-success':'text-danger' }}"><i class="fa {{$th->thermo_issues==0?'fa-check-circle text-success':'fa-exclamation-triangle text-danger' }}"></i> {{$th->thermo_issues==0?'Q':$th->thermo_issues }}</td>
                                    <td>{{$th->thermo_check_item}}</td>
                                    <td>{{$th->thermo_check_mc}}</td>
                                    <td>{{$th->thermo_check_mt}}</td>
                                    <td>{{$th->thermo_check_color}}</td>
                                    <td><small>{{$th->thermo_check_date}} {{$th->thermo_check_time}}</small></td>
                                    <td>{{$th->thermo_check_height}}</td>
                                    <td>{{$th->thermo_check_top}}</td>
                                    <td>{{$th->thermo_check_outer}}</td>
                                    <td>{{$th->thermo_check_bottom}}</td>
                                    <td>{{$th->thermo_check_brim}}</td>
                                    <td>{{$th->thermo_check_body}}</td>
                                    <td>{{$th->thermo_check_base}}</td>
                                    <td>{{$th->thermo_check_width}}</td>
                                    <td>{{$th->thermo_check_volume}}</td>
                                </tr>
                               @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
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
      
      var table = $('#thermolist').DataTable({
          "sDom": 'Rfrtlip',
          "order": [ ],
      });
    });
</script>
@endsection
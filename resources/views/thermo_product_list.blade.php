@extends(session('AName')!=''?'admin_layout':'qc_dashboard')

@section(session('AName')!=''?'admincontent':'qccontent')

<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold">Thermo Forming Product List<span></span></h4>

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
                                    <th>Item</th>
                                    <th>Material</th>
                                    <th>Color</th>
                                    <th>Top Diameter (mm)</th>
                                    <th>Outside Diameter (mm)</th> 
                                    <th>Bottom Diameter (mm)</th>
                                    <th>Brim (mm)</th>
                                    <th>Body (mm)</th>
                                    <th>Base (mm)</th>
                                    <th>Height(mm)</th>
                                    <th>Weight(mm)</th>
                                    <th>Capacity(mm)</th>
                                    <th class="{{session('AName')!=''?'':'d-none'}}"></th>
                                    <th class="{{session('AName')!=''?'':'d-none'}}"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $admin)
                                <tr>


                                    <td>{{$admin['thermo_items_name']}}</td>
                                    
                                    <td>{{$admin['thermo_items_mt']}}</td>
                                    <td>{{$admin['thermo_items_color']}}</td>
                                    <td>{{$admin['thermo_item_top']}}</td>
                                    <td>{{$admin['thermo_item_outside']}}</td>
                                    <td>{{$admin['thermo_item_bottom']}}</td>
                                    <td>{{$admin['thermo_item_brim']}}</td>
                                    <td>{{$admin['thermo_item_body']}}</td>
                                    <td>{{$admin['thermo_item_base']}}</td>
                                    <td>{{$admin['thermo_item_height']}}</td>
                                    <td>{{$admin['thermo_item_weight']}}</td>
                                    <td>{{$admin['thermo_item_capacity']}}</td>

                                    <td class="{{session('AName')!=''?'':'d-none'}}">
                                        <a href="{{ "delete_thermo_pr/".$admin['thermo_items_id'] }}" class="btn btn-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a>
                                    </td>
                                    <td class="{{session('AName')!=''?'':'d-none'}}">
                                        <a href="{{ "edit_thermo_pr/".$admin['thermo_items_id'] }}" class="btn btn-success btn-sm">Edit</a>
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
    $(document).ready(function() {

        var table = $('#qualityongoing').DataTable({
            "sDom": 'Rfrtlip',
            "order": [],
        });
    });
</script>
@endsection
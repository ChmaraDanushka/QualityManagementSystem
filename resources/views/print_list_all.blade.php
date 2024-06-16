@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-4 col-xs-12">
                <h4 class="title fw-bold">Print Lists History<span></span></h4>

            </div>
        </div>


        

        <div class="row">
            <div class="col-md-11">
                <div class="panel ">
                    <div class="panel-body pt-3 table-responsive">

                        <table class="table" id="printlist">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>M/C No</th>
                                    <th>Order Name </th>
                                    <th> Created At </th>                           
                                    <th> Qty Checked </th>
                                    <th> Color Variations </th>
                                    <th> Missing Symbols/Letters </th>
                                    <th> Smudged Symbols/Letters </th>
                                    <th> Block Alignments </th>
                                    <th> Ink Dryness </th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($print_list as $pl)
                                <tr>
                                <td class="fw-bold {{$pl->print_issues==0?'text-success':'text-danger' }}"><i class="fa {{$pl->print_issues==0?'fa-check-circle text-success':'fa-exclamation-triangle text-danger' }}"></i> {{$pl->print_issues==0?'Q':$pl->print_issues }}</td>
                                    <td>{{$pl->print_che_mc}}</td>
                                    <td>{{$pl->print_che_name}}</td>
                                    <td><small>{{$pl->print_che_date}} {{$pl->print_che_time}}</small></td>
                                    <td>{{$pl->print_che_qty}}</td>
                                    <td>{{$pl->print_che_cVa}}</td>
                                    <td>{{$pl->print_che_missing}}</td>
                                    <td>{{$pl->print_che_smudge}}</td>
                                    <td>{{$pl->print_che_block}}</td>
                                    <td>{{$pl->print_che_ink}}</td>
                                    
                                </tr>
                               @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>









</main>
</div>


@endsection

@section('page-scripts')
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
        table = document.getElementById("printlist");
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

<script>
    $(document).ready(function(){
      
    var table = $('#printlist').DataTable({
        "sDom": 'Rfrtlip',
        "order": [ ],
    });
    
        
        $("#material_type").change(function(){ 
        var element = $(this).find('option:selected'); 
        var myTag = element.attr("data-attr"); 
        var batchnamecreate = myTag.split('-');

        // Get the first letters of the values
        var firstLetter1 = batchnamecreate[0].charAt(0);
        var firstLetter2 = batchnamecreate[1].charAt(0);

        //get current datetime to batch no
        var year =new Date().getFullYear().toString().substr(-1);
        var month = (new Date().getMonth() + 1).toString();
        var date = (new Date().getDate() ).toString();
        var hour = (new Date().getHours()).toString();
        var min = (new Date().getMinutes()).toString();
        var sec = (new Date().getSeconds() ).toString();
        
        // Combine the first letters and set them in the output field
        var output = document.getElementById("ch_roll_batch");
        output.value = firstLetter1 + firstLetter2+year+month+date+hour+min+sec;
    });
    });
   
</script>
@endsection
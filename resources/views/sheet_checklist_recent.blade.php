@extends('qc_dashboard')

@section('qccontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-4 col-xs-12">
                <h4 class="title fw-bold">Recent Checklists<span></span></h4>

            </div>
        </div>


        

        <div class="row">
            <div class="col-md-11">
                <div class="panel ">
                    <div class="panel-body pt-3 table-responsive">

                        <table class="table" id="chlistsheet">
                            <thead>
                                <tr>
                                <th> Status </th>
                                    <th>M/C No</th>
                                    <th>Material Type</th>
                                    <th> Standard Color </th>
                                    <th> Standard Width </th>
                                    <th> Standard Thicknes </th>
                                    <th> Created at </th>
                                    <th> Roll batch No </th>
                                    <th> Roll width </th>
                                    <th> Contaminations Or Dust </th>
                                    <th> Right Thickness </th>
                                    <th> Middle right Thickness</th>
                                    <th> Middle left Thickness </th>
                                    <th> left Thickness </th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ch_list as $ls)
                                <tr>
                                <td class="fw-bold {{$ls->sheet_issues==0?'text-success':'text-danger' }}"><i class="fa {{$ls->sheet_issues==0?'fa-check-circle text-success':'fa-exclamation-triangle text-danger' }}"></i> {{$ls->sheet_issues==0?'Q':$ls->sheet_issues }}</td>
                                    <td>{{$ls->sheet_chc_mc}}</td>
                                    <td>{{$ls->sheet_chc_mt}}</td>
                                    <td>{{$ls->sheet_chc_color}}</td>
                                    <td>{{$ls->sheet_chc_width}}</td>
                                    <td>{{$ls->sheet_chc_thickness}}</td>
                                    <td><small>{{$ls->sheet_chc_date}} {{$ls->sheet_chc_time}}</small></td>
                                    <td>{{$ls->sheet_chc_rollBatch}}</td>
                                    <td>{{$ls->sheet_chc_rollWidth}}</td>
                                    <td>{{$ls->sheet_chc_roll_dust}}</td>
                                    <td>{{$ls->sheet_chc_roll_r}}</td>
                                    <td>{{$ls->sheet_chc_roll_mr}}</td>
                                    <td>{{$ls->sheet_chc_roll_ml}}</td>
                                    <td>{{$ls->sheet_chc_roll_l}}</td>
                                    

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
        table = document.getElementById("chlistsheet");
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
      
    var table = $('#chlistsheet').DataTable({
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
@extends('admin_layout')

@section('admincontent')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold">CUP/LID Printing Report<span></span></h4>

            </div>
        </div>


        <!-----------------------------------Mixcher add------------------------------------------------>





        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->
        <div class="row">
            <form action="{{route('genarate-printing-report')}}" method="post">
                @csrf
                <div class="row">

                    <div class="col-3">
                        <div class="form-group ">
                            <input type="text" class="form-control" name="daterange" value="{{old('daterange')}}" />
                        </div>
                    </div>

                    <div class="col-6 px-2">
                        <div class="form-group ">
                            <select  name="product" class="form-select" required="required">
                                <option value="0">- All Products -</option>
                                @foreach($products as $p)
                                <option value="{{$p->print_cus_id}}" {{$p->print_cus_id==old('product')?'selected':''}}>{{$p->print_cus_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>


                    <div class="col-2 px-2">
                        <div class="form-group ">
                            <select  name="status" class="form-select" required="required">
                                <option value="0">- All Status -</option>
                                <option value="1" {{1==old('status')?'selected':''}}>QC Failed</option>
                                <option value="2" {{2==old('status')?'selected':''}}>QC Passed</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-4 px-2">
                        <button class="btn btn-primary btn-xs" type="submit"> Generate</button>
                        <a class="btn btn-outline-primary btn-xs" href="{{route('printing-report')}}"> Reset</a>
                        <button class="btn btn-success btn-xs" onclick="generate()">Download</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel">

                    <div class="panel-body pt-3 table-responsive">

                    <table class="table" id="printlist">
                            <thead>
                                <tr>
                                <th> Created At </th>  
                                    <th>Status</th>
                                    <th>M/C No</th>
                                    <th>Order Name </th>
                                                             
                                    <th> Qty Checked </th>
                                    <th> Color Variations </th>
                                    <th> Missing Symbols/Letters </th>
                                    <th> Smudged Symbols/Letters </th>
                                    <th> Block Alignments </th>
                                    <th> Ink Dryness </th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($admin as $pl)
                                <tr>
                                <td><small>{{$pl->print_che_date}} {{$pl->print_che_time}}</small></td>
                                <td class="fw-bold {{$pl->print_issues==0?'text-success':'text-danger' }}"><i class="fa {{$pl->print_issues==0?'fa-check-circle text-success':'fa-exclamation-triangle text-danger' }}"></i> {{$pl->print_issues==0?'Q':$pl->print_issues }}</td>
                                    <td>{{$pl->print_che_mc}}</td>
                                    <td>{{$pl->print_che_name}}</td>
                                   
                                    <td>{{$pl->print_che_qty}}</td>
                                    <td>{{$pl->print_che_cVa}}</td>
                                    <td>{{$pl->print_che_missing}}</td>
                                    <td>{{$pl->print_che_smudge}}</td>
                                    <td>{{$pl->print_che_block}}</td>
                                    <td>{{$pl->print_che_ink}}</td>
                                    
                                </tr>
                               @endforeach
                            </tbody>

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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{asset('js/jspdf.umd.js')}}"></script>
<script src="{{asset('js/jspdf.plugin.autotable.js')}}"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'center'
        }, function(start, end, label) {

        });
    });
    $(document).ready(function() {

        //   var table = $('#qualityall').DataTable({
        //       "sDom": 'Rfrtlip',
        //       "order": [ ],
        //   });
    });
</script>
<script>
      function generate() {
        var doc = new jspdf.jsPDF('l', 'mm', [297, 210])

        // Simple data example
        

        // Simple html example
        doc.autoTable({ html: '#printlist' })

        doc.save('report.pdf')
      }
    </script>
@endsection
@extends('qc_dashboard')

@section('qccontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row"  id="title_bar">

<hr>
<main class="container" >
<div class="col" id="form_title">
<div class="col col-sm-12 col-xs-12">
                            <h4 class="title fw-bold"> Material Mixture of the sheet<span></span></h4>

                        </div>
                        </div>


                        <form action="{{ route('sheet_mixture_add') }}" method="POST" class="modern-form" id="add_admin_form">
    @csrf

    {{-- Success and Error Messages --}}
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif

    

    <div class="container" >
 

 
    </div>
    <div class="container" style="margin-top:-70px" >
    <div class="row"   style="background-color:white;width:980px;margin-left:-66px">
    <!-- <div class="col-sm">
    <label for="mixture_time">Time</label>
    <input type="time" class="form-control" id="mixture_time" name="mixture_time">
</div> -->

<!-- <div class="col-sm">
    <label for="mixture_date">Date</label>
    <input type="date" class="form-control" id="mixture_date" name="mixture_date">
</div> -->

<!-- <script>
    // Get current date and time
    const currentDate = new Date();

    // Format time to match the time input format (HH:mm)
    const formattedTime = currentDate.toLocaleTimeString('en-US', { hour12: false });

    // Set values in the input fields
    document.getElementById('mixture_time').value = formattedTime;
    document.getElementById('mixture_date').value = currentDate.toISOString().split('T')[0]; // Adjust as needed
</script> -->


        <!-- <div class="col-sm">
        <label for="standard_thickness">Batch No</label> <input type="text" class="form-control" id="" name="mixture_batch_number"> 
        </div> -->


        <h5>Matirial Data Table</h5>
        <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border-bottom: 1px solid gray;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
    <hr>
    <table >
    <thead>
        <tr>
            <th>Material</th>
            <th>Our B/N no</th>
            <th>Brand</th>
            <th>QTY</th>
            <th>Mixed %</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <select class="form-control" id="material_1" name="material_1">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_name'] }}">{{ $item['sheet_material_name'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="our_bn_no_1"  id="our_bn_no_1"></td>
        <td>
            <select class="form-control" id="mt_brand_1" name="mt_brand_1">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_brand'] }}">{{ $item['sheet_material_brand'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="qty_1"  id="qty_2"  class="qty"></td>
        <td><input type="text" name="mixed_1" id="mixed_1"  class="mixed"></td>
    </tr>

    <tr>
        <td>
            <select class="form-control" id="material_2" name="material_2">
                <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_name'] }}">{{ $item['sheet_material_name'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="our_bn_no_2" id="our_bn_no_2"></td>
        <td>
            <select class="form-control" id="mt_brand_2" name="mt_brand_2">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_brand'] }}">{{ $item['sheet_material_brand'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="qty_2" id="qty_2"  class="qty"></td>
        <td><input type="text" name="mixed_2" id="mixed_2"  class="mixed"></td>
    </tr>

    



    <tr>
        <td>
            <select class="form-control" id="material_3" name="material_3">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_name'] }}">{{ $item['sheet_material_name'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="our_bn_no_3" id="our_bn_no_3"></td>
        <td>
            <select class="form-control" id="mt_brand_3" name="mt_brand_3">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_brand'] }}">{{ $item['sheet_material_brand'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="qty_3" id="qty_3"  class="qty"></td>
        <td><input type="text" name="mixed_3" id="mixed_3"  class="mixed"></td>
    </tr>

    <tr>
        <td>
            <select class="form-control" id="material_4" name="material_4">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_name'] }}">{{ $item['sheet_material_name'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="our_bn_no_4"  id="our_bn_no_4"></td>
        <td>
            <select class="form-control" id="mt_brand_4" name="mt_brand_4">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_brand'] }}">{{ $item['sheet_material_brand'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="qty_4" id="qty_4"  class="qty"></td>
        <td><input type="text" name="mixed_4"  id="mixed_4" class="mixed"></td>
    </tr>


    <tr>
        <td>
            <select class="form-control" id="material_5" name="material_5">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_name'] }}">{{ $item['sheet_material_name'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="our_bn_no_5" id="our_bn_no_5"></td>
        <td>
            <select class="form-control" id="mt_brand_5" name="mt_brand_5">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_brand'] }}">{{ $item['sheet_material_brand'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="qty_5"  id="qty_5" class="qty"></td>
        <td><input type="text" name="mixed_5" id="mixed_5"  class="mixed"></td>
    </tr>

    
    <tr>
        <td>
            <select class="form-control" id="material_6" name="material_6">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_name'] }}">{{ $item['sheet_material_name'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="our_bn_no_6" id="our_bn_no_6"></td>
        <td>
            <select class="form-control" id="mt_brand_6" name="mt_brand_6">
            <option value=""></option>
                @foreach ($admin as $item)
                <option value="{{ $item['sheet_material_brand'] }}">{{ $item['sheet_material_brand'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="qty_6" id="qty_6"  class="qty"></td>
        <td><input type="text" name="mixed_6" id="mixed_6"  class="mixed"></td>
    </tr>


    <!-- Repeat the structure for the remaining rows -->

   
</tbody>


</table>


<div class="col-sm" style="margin-top:20px;margin-left:450px">
    <label for="qty_total">QTY Total</label><br>
    <input type="text" name="qty_total" id="qty_total">
</div>
<div class="col-sm" style="margin-top:20px">
    <label for="mixed_total">Mixed Total %</label> <br>
    <input type="text" name="mixed_total" id="mixed_total">
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




    <!-- Button Section -->
    <div class="text-right mt-3" style="margin-bottom:-10px">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="reset" class="btn btn-secondary">Clear</button>
    </div>

    <!-- Additional form-groups go here -->
    
</form>


<!-----------------------------------Mixcher add------------------------------------------------>





<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

    <!-- <div class="row">
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
                              
                               
                                <th>M/C No</th>
                                <th>Material Type</th>
                                <th>  Standard Color  </th>
                                <th>  Batch No  </th>
                                <th>  Standard Width  </th>
                                <th>  Standard Thicknes  </th>
                                <th>   Time </th>
                                <th>   Date </th>
                                <th>   Roll batch No </th>
                                <th>   Roll width </th>
                                <th>   Contaminations Or Dust </th>
                                <th>   Right Thickness </th>
                                <th>   Middle right Thickness</th>
                                <th>   Middle left Thickness </th>
                                <th>  left Thickness </th>
                                <th>   Right Thickness </th>
                           
                            </tr>
                        </thead>

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
$(document).ready(function() {
    // Function to update QTY Total
    function updateQtyTotal() {
        var qtyTotal = 0;

        // Loop through each row in the table
        $('tbody tr').each(function() {
            // Get the value from the QTY input in the current row
            var qtyValue = parseFloat($(this).find('.qty').val()) || 0;
            
            // Add the value to the total
            qtyTotal += qtyValue;
        });

        // Update the QTY Total input
        $('#qty_total').val(qtyTotal);
    }

    // Trigger the update when any .qty input changes
    $('.qty').on('input', function() {
        updateQtyTotal();
    });

    // Call the function initially to set the default values
    updateQtyTotal();
});
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
    // Function to update QTY Total and Mixed Percentage
    function updateTotals() {
        var qtyTotal = 0;

        // Loop through each row in the table
        $('tbody tr').each(function() {
            // Get the value from the QTY input in the current row
            var qtyValue = parseFloat($(this).find('.qty').val()) || 0;

            // Add the value to the total
            qtyTotal += qtyValue;
        });

        // Update the QTY Total input
        $('#qty_total').val(qtyTotal);

        // Loop through each row again to calculate and update Mixed Percentage
        $('tbody tr').each(function() {
            // Get the value from the QTY input in the current row
            var qtyValue = parseFloat($(this).find('.qty').val()) || 0;

            // Calculate the Mixed Percentage
            var mixedPercentage = (qtyValue / qtyTotal) * 100;

            // Update the Mixed Percentage input in the current row
            $(this).find('.mixed').val(mixedPercentage.toFixed(2)); // Round to 2 decimal places
        });
    }

    // Trigger the update when any .qty input changes
    $('.qty').on('input', function() {
        updateTotals();
    });

    // Call the function initially to set the default values
    updateTotals();
});
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
    // Function to update QTY Total and Mixed Percentage
    function updateTotals() {
        var qtyTotal = 0;
        var mixedTotal = 0;

        // Loop through each row in the table
        $('tbody tr').each(function() {
            // Get the value from the QTY input in the current row
            var qtyValue = parseFloat($(this).find('.qty').val()) || 0;
            // Add the value to the total
            qtyTotal += qtyValue;

            // Get the value from the Mixed Percentage input in the current row
            var mixedValue = parseFloat($(this).find('.mixed').val()) || 0;
            // Add the value to the Mixed Total
            mixedTotal += mixedValue;
        });

        // Update the QTY Total input
        $('#qty_total').val(qtyTotal);

        // Update the Mixed Total input
        $('#mixed_total').val(mixedTotal.toFixed(2)); // Round to 2 decimal places
    }

    // Trigger the update when any .qty or .mixed input changes
    $('.qty, .mixed').on('input', function() {
        updateTotals();
    });

    // Call the function initially to set the default values
    updateTotals();
});
</script>



@endsection

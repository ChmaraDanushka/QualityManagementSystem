@extends('qc_dashboard')

@section('qccontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold">Sheet Extruder online check list<span></span></h4>

            </div>
        </div>


        <form action="{{ route('sheet_online_checklist_add') }}" method="POST" class="modern-form" id="add_admin_form">
            @csrf

            {{-- Success and Error Messages --}}
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif

            <div class="container">
                
                <h5>Product Data</h5>
                <hr>
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mc_no">Machine No</label>
                            <select class="form-control" id="mc_no" name="mc_no">
                                <option value="" disabled selected>Select Machine</option>
                                @foreach ($admin as $admin)
                                <option value="{{ $admin['mc_no'] }}">{{ $admin['mc_no'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('mc_no') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="standard_width">Standard Width</label>
                            <select class="form-control" id="standard_width" name="standard_width">
                                <option value="" disabled selected>Select Width</option>
                                @foreach ($product as $item)
                                <option value="{{ $item['s_width'] }}">{{ $item['s_width'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('standard_width') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group d-none">
                            <label for="standard_color">Standard Color</label>
                            <select class="form-control" id="standard_color" name="standard_color">
                                <option value=""></option>
                                
                            </select>
                            <span class="text-danger">@error('standard_color') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6 ">
                        <div class="form-group d-none">
                            <label for="batch_no">Batch No</label>
                            <select class="form-control" id="batch_no" name="batch_no">
                                <option value=""></option>
                                
                            </select>
                            <span class="text-danger">@error('batch_no') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="material_type">Material Type</label>
                            <select class="form-control" id="material_type" name="material_type">
                                <option value="" disabled selected>Seletct Material</option>
                                @foreach ($product as $item)
                                <option value="{{ $item['s_type'] }}-{{$item['s_color']}}" data-attr="{{ $item['s_type'] }}-{{$item['s_color']}}">{{ $item['s_type'] }}-{{$item['s_color']}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('material_type') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="standard_thicknes">Standard Thicknes</label>
                            <select class="form-control" id="standard_thicknes" name="standard_thicknes">
                                <option value="" disabled selected>Select Thicknes</option>
                                @foreach ($product as $item)
                                <option value="{{ $item['s_thickness'] }}">{{ $item['s_thickness'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('standard_thicknes') {{ $message }} @enderror</span>

                        </div>


                    </div>
                </div>
            </div>
            <div class="container" style="margin-top:-70px">
                <h5>Ongoing Product Check Data </h5>
                <hr>
                <div class="row">
                    <div class="col-sm d-none">
                        <label for="standard_thickness">Time</label> <input type="text" name="ch_time" id="ch_time">
                    </div>

                    <div class="col-sm d-none">
                        <label for="standard_thickness">Date</label> <input type="text" name="ch_date" id="ch_date">
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="roll_batch">Roll Batch No</label> <input type="text" class="form-control" placeholder="Batch No" name="ch_roll_batch" id="ch_roll_batch">
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="current_roll_width">Roll width</label> <input type="text" class="form-control" placeholder="Width" name="ch_roll_width" id="">
                        </div>

                    </div>
                    <div class="col">

                        <div class="form-group">
                            <label for="standard_thickness">Contaminations Or Dust</label>
                            <select class="form-control" id="standard_thickness" name="ch_roll_dust">
                                <option value="">Select Option</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div>



                <hr>
                <h5>Ongoing Sheet Thikness</h5>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="left">Right Thickness</label> <input type="text" name="ch_roll_r" class="form-control" id="">
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="middle_left">Middle right Thickness</label> <input type="text" name="ch_roll_mr" class="form-control" id="">
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="middle_right">Middle left Thickness</label> <input type="text" name="ch_roll_ml" class="form-control" id="">
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="right">left Thickness</label> <input type="text" name="ch_roll_l" class="form-control" id="">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <!-- Button Section -->
                    <div class="text-right mt-3" style="margin-bottom:-10px">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </div>
                </div>
            </div>



        </form>


       
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
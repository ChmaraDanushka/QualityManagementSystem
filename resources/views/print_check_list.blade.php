@extends('qc_dashboard')

@section('qccontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-4 col-xs-12">
                <h4 class="title fw-bold">Printing Online Check List<span></span></h4>

            </div>
        </div>


        <form action="{{ route('print_check') }}" method="POST" class="modern-form" id="add_admin_form">
            @csrf

            {{-- Success and Error Messages --}}
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif

            <div class="container">
                <hr>
                <h5>Product Data</h5>
                <hr>
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mc_no">Machine No</label>
                            <select class="form-control" id="mc_no" name="mc_no">
                                <option value="" selected disabled>Select Machine</option>
                                @foreach ($admin as $admin)
                                <option value="{{ $admin['printing_mc_no'] }}">{{ $admin['printing_mc_no'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('mc_no') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="standard_width">Batch No</label>
                            <select class="form-control" id="item_batch" name="item_batch">
                                <option value="" selected disabled>Select Batch No</option>
                                @foreach ($ch_list as $ch)
                                <option value="{{ $ch['sheet_chc_rollBatch'] }}">{{ $ch['sheet_chc_rollBatch'] }}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">@error('item_batch') {{ $message }} @enderror</span>
                        </div>   

                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="item_name">Oder Name</label>
                            <select class="form-control" id="item_name" name="item_name">
                                <option value="" selected disabled>Select Order</option>
                                @foreach ($product as $item)
                                <option value="{{ $item['print_cus_id'] }}">{{ $item['print_cus_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('item_name') {{ $message }} @enderror</span>
                        </div>
                        


                    </div>
                </div>
            </div>
            <div class="container" style="margin-top:-70px">
                
                <div class="row">
                    
                    
                    <hr>
                    <h5>Ongoing Item Quality</h5>
                    <hr>
                    <div class="col-4 form-group">
                        <label for="qty_ch">QTY Checked</label> 
                        <input type="text" name="qty_ch" class="form-control">
                    </div>
                    <div class="col-4 form-group">
                        <label for="middle_left">Color Variations from standerd</label> 
                        <select  name="color_va" id="" class="form-control">
                            <option value="" selected disabled>Check Resault</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="middle_right">Missing simbles and Letters</label> 
                        <select  name="missin_si" id="" class="form-control">
                            <option value="" selected disabled>Check Resault</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="right">smudged simbles and letters</label> 
                        <select  name="smudge_si" id="" class="form-control">
                            <option value="" selected disabled>Check Resault</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="left">Block Alignment</label><br>
                        <select  name="block_al" id="" class="form-control">
                            <option value="" selected disabled>Check Resault</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="middle_left">Ink Dryness</label> <br>
                        <select  name="ink_dry" id="" class="form-control">
                            <option value="" selected disabled>Check Resault</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>


                </div>
            </div>

            <!-- Button Section -->
            <div class="text-right mt-3" style="margin-bottom:-10px">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>

            <!-- Additional form-groups go here -->
        </form>


        <!-----------------------------------Mixcher add------------------------------------------------>





        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->


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
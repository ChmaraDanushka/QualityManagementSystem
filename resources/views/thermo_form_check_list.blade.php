@extends('qc_dashboard')

@section('qccontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold">Thermo Forming online check list<span></span></h4>

            </div>
        </div>


        <form action="{{ route('thermo_check') }}" method="POST" class="modern-form" id="add_admin_form">
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
                                <option value="" disabled selected>Select Machine</option>
                                @foreach ($admin as $admin)
                                <option value="{{ $admin['thermo_mc_no'] }}">{{ $admin['thermo_mc_no'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('mc_no') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group d-none">
                            <label for="material_type">Material Type</label>
                            <select class="form-control" id="material_type" name="material_type">
                                <option value="" selected disabled>Select Material</option>
                                @foreach ($product as $item)
                                <option value="{{ $item['thermo_items_mt'] }}">{{ $item['thermo_items_mt'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('material_type') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group d-none">
                            <label for="standard_color">Standard Color</label>
                            <select class="form-control" id="standard_color" name="standard_color">
                                <option value=""></option>
                                @foreach ($product as $item)
                                <option value="{{ $item['thermo_items_color'] }}">{{ $item['thermo_items_color'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('standard_color') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="standard_width">Batch No</label>
                            <select class="form-control" id="item_batch" name="item_batch">
                                <option value="" disabled selected>Select Batch No</option>
                                @foreach ($ch_list as $ch)
                                <option value="{{ $ch['sheet_chc_rollBatch'] }}">{{ $ch['sheet_chc_rollBatch'] }}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">@error('standard_width') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="batch_no">Item Name</label>
                            <select class="form-control" id="item_name" name="item_name">
                                <option value="" selected disabled>Select Item</option>
                                @foreach ($product as $item)
                                <option value="{{ $item['thermo_items_id'] }}">{{ $item['thermo_items_name'] }} - {{ $item['thermo_items_mt'] }} - {{ $item['thermo_items_color'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('batch_no') {{ $message }} @enderror</span>
                        </div>


                    </div>
                </div>
            </div>
            <div class="container" style="margin-top:-70px">
               
                <div class="row">
                    
                    <h5>Ongoing Item Quality</h5>
                    <hr>
                    <div class="col-sm">
                        <label for="left">Height</label> <input type="text" name="height" id="">
                    </div>
                    <div class="col-sm">
                        <label for="middle_left">Top Diameter</label> <input type="text" name="top_di" id="">
                    </div>
                    <div class="col-sm">
                        <label for="middle_right">Outer Diameter</label> <input type="text" name="outer_di" id="">
                    </div>
                    <div class="col-sm">
                        <label for="right">Bottom Diameter</label> <input type="text" name="bottom_di" id="">
                    </div>

                    <div class="col-sm">
                        <label for="left">Brim Thikness</label> <input type="text" name="brim_thi" id="">
                    </div>
                    <div class="col-sm">
                        <label for="middle_left">Body Thikness</label> <input type="text" name="body_thi" id="">
                    </div>
                    <div class="col-sm">
                        <label for="middle_right">Base Thikness</label> <input type="text" name="base_thi" id="">
                    </div>
                    <div class="col-sm">
                        <label for="right">Weight</label> <input type="text" name="weight" id="">
                    </div>
                    <div class="col-sm">
                        <label for="right">Volume</label> <br><input type="text" name="volume" id="">
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

        @section('page-scripts')
        <script>
            $(document).ready(function(){
                var ch_list = '<?php echo $ch_list; ?>';
                var items = '<?php echo $product; ?>';

                
            });
        </script>
        @endsection
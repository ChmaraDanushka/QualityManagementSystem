@extends('qc_dashboard')

@section('qccontent')

<link href="{{asset('/css/my.css')}}" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid" id="dash_back">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h3 class="h6 mb-0 text-gray-800">Dashboard</h3>-->

    </div>

    <!-- Content Row -->
    <div class="row">
        {{-- Success and Error Messages --}}
        @if (Session::has('success'))
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
        @endif

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                SHEET EXTRUDER</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['sheet_mc_count']}}</div>
                        </div>
                        <div class="col-auto">
                            <img src="assets/img/extruder.png" class="img-fluid" alt="Responsive image" style="max-width: 60%; height: auto; border-radius: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                THERMO
                                FORMING</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['thermo_mc_count']}}</div>
                        </div>
                        <div class="col-auto">
                            <img src="assets/img/thermo.png" class="img-fluid" alt="Responsive image" style="max-width: 50%; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> PRINTING
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['printing_mc_count']}}</div>
                        </div>
                        <div class="col-auto">
                            <img src="assets/img/mug.png" class="img-fluid" alt="Responsive image" style="max-width: 60%; height: auto; border-radius: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 d-none">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                FOIL PRINTER</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                        </div>
                        <div class="col-auto">
                            <img src="assets/img/aluminium.png" class="img-fluid" alt="Responsive image" style="max-width: 60%; height: auto; border-radius: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------------------- section 2 ------------------------------------>


    <!-- Pending Requests Card Example -->


    <!------------------ section 2 ------------------------------------>
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-22 col-lg-12">
            <div class="card shadow mb-6">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">ONGOING PRODUCTS (DAYILY)</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!---------------------- secont charts  ------------------------------->

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">SEND MASSAGES</h6>
                    <a href="" data-toggle="modal" data-target="#newMessage"> <i class="fa fa-plus"></i> </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="col-12" style="height:350px;overflow-y:auto;">
                        @foreach($data['msgs'] as $m)
                        <div class="row border {{$m->is_read==0?'border-warning':''}} py-2">
                            <div class="col-2">
                                <small class="mb-0">{{$m->from_name}}</small>

                            </div>
                            <div class="col-6">
                                <small class="mb-0">{{$m->message}}</small>
                            </div>
                            <div class="col-3">
                                <small>{{date('H:i:s Y-m-d',strtotime($m->create_time))}}</small>
                            </div>
                            <div class="col-1">
                                <a class="viewmsg_btn" data-toggle="modal" data-target="#viewMessage" data-cont="{{$m}}" data-id="{{$m->id}}" data-from="{{$m->from_name}}" data-msg="{{$m->message}}"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7" style="left:20px;">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">CRITICAL LOG BOOK REVIEW</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body ">
                <div class="col-12 " style="height:350px;overflow-y:auto;">
                    <table class="table " style="width:100%;">
                        <tbody>
                            @if(count($data['logs_sheet']))
                            <tr>
                                <th>Sheet Extruder Logs</th>
                            </tr>
                            @endif
                            @foreach($data['logs_sheet'] as $d)
                            <tr>
                                <td class="text-danger">Quality Error on Sheet Extruder No#{{$d->sheet_chc_id}}</td>
                            </tr>
                            @endforeach
                            @if(count($data['logs_forms']))
                            <tr>
                                <th>Thermo Form Logs</th>
                            </tr>
                            @endif
                            @foreach($data['logs_forms'] as $d)
                            <tr>
                                <td class="text-danger">Quality Error on Thermo Forming No#{{$d->thermo_check_id}}</td>
                            </tr>
                            @endforeach
                            @if(count($data['logs_prints']))
                            <tr>
                                <th>CUP/LID Print Logs</th>
                            </tr>
                            @endif
                            @foreach($data['logs_prints'] as $d)
                            <tr>
                                <td class="text-danger">Quality Error on CUP/LID Printing No#{{$d->print_che_id}}</td>
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






</div>
<!-- second chaet end  -------------------------------------------->
<!-- /.container-fluid -->

</div>

<!-- Modal -->
<div class="modal fade" id="viewMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message From : <span id="msg_from"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="msg"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{route('mark-message-read')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="msg_id">
                    <button type="submit" class="btn btn-primary">Mark as Read</button>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Write Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('write-message')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Select User</label>
                        <select name="user" id="" required class="form-control">
                            <option value="0">-select user-</option>
                            @foreach($data['admins'] as $d)
                            <option value="{{$d->user_id}}-{{$d->user_first_name}}">{{$d->user_first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea class="form-control" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End of Main Content -->



@endsection

@section('page-scripts')
<script>
    var sheet = <?php echo $data['sheet_daily']; ?>;
    var thermo = <?php echo $data['thermo_daily']; ?>;
    var print = <?php echo $data['print_daily']; ?>;
    var data_array = [];
    data_array.push(sheet);
    data_array.push(thermo);
    data_array.push(print);
    console.log(data_array);

    $(document).ready(function() {

        $('.viewmsg_btn').click(function() {

            $('#msg_from').text('');
            $('#msg').text('');
            $('#msg_id').val('');
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-from');
            var msg = $(this).attr('data-msg');
            $('#msg_from').text(name);
            $('#msg').text(msg);
            $('#msg_id').val(id);
        });
    });
</script>
@endsection('page-scripts')
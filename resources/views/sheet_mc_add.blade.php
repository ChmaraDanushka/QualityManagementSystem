@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

  <hr>
  <main class="container">
    <div class="col" id="form_title">
      <div class="col col-sm-3 col-xs-12">
        <h6 class="title">Add Sheet Extruder<span></span></h6>

      </div>
    </div>
    <form action="{{ route('sheet_mc_add') }}" method="POST" class="modern-form" id="add_admin_form">
      @csrf

      {{-- Success and Error Messages --}}
      @if (Session::has('success'))
      <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
      @endif

      @if (Session::has('error'))
      <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">MC NO</label>
            <input type="text" id="mc_no" name="mc_no" value="" class="form-control form-control-sm" />
          </div>
          <div class="form-group">
            <label for="mc_name">MC Name</label>
            <input type="text" id="mc_name" name="mc_name" value="" class="form-control form-control-sm" />
          </div>

        </div>
        <div class="col-md-6">

          <div class="form-group">
            <label for="main_matirial">Main Material</label>
            <select type="text" id="main_matirial" name="main_matirial" value="" class="form-control form-control-sm">
              <option value="">...Material Option...</option>
              <option value="PP">PP (Polypropylene)</option>
              <option value="HIPS">HIPS (High Impact Polystyrene)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comp">Secondry Material</label>
            <select type="text" id="second_matirial" name="second_matirial" value="" class="form-control form-control-sm">
              <option value="">...Material Option...</option>
              <option value="PP">PP (Polypropylene)</option>
              <option value="HIPS">HIPS (High Impact Polystyrene)</option>
            </select>
          </div>
        </div>

      </div>

      <div class="text-right">
        <button type="submit" class="btn btn-primary">Add</button>

        <button type="reset" class="btn btn-secondary">Clear</button>
      </div>
    </form>




    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <div class="panel">
          <div class="panel-heading">
            <div class="row">
              <div class="col col-sm-3 col-xs-12">
                <h4 class="title">Machine <span>List</span></h4>
              </div>
              <div class="col-sm-9 col-xs-12 text-right">
                <div class="btn_group">
                  <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search">
                  <button class="btn btn-default" title="Reload"><i class="fa fa-sync-alt"></i></button>
                  <button class="btn btn-default" title="Pdf"><i class="fa fa-file-pdf"></i></button>
                  <button class="btn btn-default" title="PDF" id="downloadPDF"><i class="fa fa-file-pdf"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body table-responsive">

            <table class="table" id="myTable">
              <thead>
                <tr>


                  <th></th>
                  <th>M/C Id</th>
                  <th>Name</th>
                  <th>Main Matirial</th>
                  <th>Secondry Matirial</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admin as $admin)
                <tr>
                  <td><i class="fa fa-circle {{$admin['mc_status']==0?'text-danger':'text-success'}}"></i> </td>
                  <td>{{$admin['mc_no']}}</td>
                  <td>{{$admin['mc_name']}}</td>
                  <td>{{$admin['first_matirial']}}</td>
                  <td>{{$admin['second_matirial']}}</td>
                  <td>
                    <form action="{{ url('start-stop-sheet-machine/'.$admin['mc_id']) }}" method="post">
                      @csrf
                      <button class="btn btn-{{$admin['mc_status']==0?'success':'warning'}} btn-sm" type="submit"><i class="fa {{$admin['mc_status']==0?'fa-play':'fa-stop'}}"></i> {{$admin['mc_status']==0?'Start':'Stop'}}</button>
                    </form>
                  </td>
                  <td>
                    <a href="{{ "delete_mc/".$admin['mc_id'] }}" class="btn btn-outline-danger btn-sm" onclick="return styledConfirm('Are you sure you want to delete this user?')">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
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

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <div class="panel">
          <div class="panel-heading">
            <div class="row">
              <div class="col col-sm-3 col-xs-12">
                <h4 class="title">Machines <span>Log</span></h4>
              </div>
              <div class="col-sm-9 col-xs-12 text-right">
                <div class="btn_group">
                  <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search">
                  <button class="btn btn-default" title="Reload"><i class="fa fa-sync-alt"></i></button>
                  <button class="btn btn-default" title="Pdf"><i class="fa fa-file-pdf"></i></button>
                  <button class="btn btn-default" title="PDF" id="downloadPDF"><i class="fa fa-file-pdf"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body table-responsive">

            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>MC I/D</th>
                  <th>Start time</th>
                  <th>Stop Time</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($logs as $l)
                  <tr>
                    <td>{{$l->log_date}}</td>
                    <td>{{$l->mc_name}}</td>
                    <td>{{$l->start_time}}</td>
                    <td>{{$l->end_time}}</td>
                  </tr>
                  @endforeach
              </tbody>
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

        </div>
      </div>
    </div>


    
  </main>
</div>
</div>
</div>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- Add click event to the PDF button to open the print view for the table -->
<script>
  $(document).ready(function() {
    // Add click event to the PDF button
    $("#downloadPDF").click(function() {
      // Open the print view for the table
      window.print();
    });
  });
</script>
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
@endsection
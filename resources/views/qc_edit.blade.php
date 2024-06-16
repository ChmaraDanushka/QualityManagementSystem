
@extends('admin_layout')

@section('admincontent')
<link href="{{asset('/css/myform.css')}}" rel="stylesheet">
<link href="{{asset('/css/form-layout.css')}}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row" id="form_title">
                        <div class="col col-sm-3 col-xs-12">
                            <h5 class="title">Edit User<span></span></h5>
                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                    
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
<div class="container-fluid">




    <form action="{{ route('update_qc') }}" method="POST" class="modern-form" id="add_admin_form" enctype="multipart/form-data">
    {{ @csrf_field() }}
    {{@method_field('PUT')}}
    {{-- Success and Error Messages --}}
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif
    <input type="hidden"   name="qc_id" value="{{$data->qc_id}}">
    <div class="row mb-2">
        <div class="col">
            <label for="user_reg_no" class="form-label">User Reg No</label>
            <input type="text" class="form-control" id="signUpFirst" name="user_reg_no" value="{{$data->qc_reg_no}}">
            <span class="text-danger">@error('user_reg_no') {{ $message }} @enderror</span>
        </div>

      <!-- Profile Picture Input -->
      <div class="row mb-3">
    
        <div class="col-12 col-sm mb-3 mb-sm-0">

        <span class="dot">
        <img src="{{ asset('uploads/admin_pro/' . $data->qc_pro_pic) }}" id="selected_image" alt="Image" title="Image Title" style="max-width: 100%; height: auto">

        </span><br>
        <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
           
            <span class="text-danger">@error('profile_picture') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label for="user_first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="signUpFirst" name="qc_first_name" value="{{$data->qc_first_name}}">
            <span class="text-danger">@error('user_first_name') {{ $message }} @enderror</span>
        </div>
        <div class="col">
            <label for="user_last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="signUpLast" name="qc_last_name" value="{{$data->qc_last_name}}">
            <span class="text-danger">@error('qc_last_name') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label for="user_nic" class="form-label">NIC</label>
            <input type="text" class="form-control" id="user_nic" name="qc_nic" value="{{$data->qc_nic}}">
            <span class="text-danger">@error('qc_nic') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="user_address" name="qc_address" value="{{$data->qc_address}}">
            <span class="text-danger">@error('qc_address') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="qc_email" value="{{$data->qc_email}}">
            <span class="text-danger">@error('qc_email') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label for="qc_tp" class="form-label">Telephone</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+94</span>
                <input type="text" class="form-control" aria-label="Telephone" aria-describedby="basic-addon1"
                    name="qc_tp"  value="{{$data->qc_tp}}">
            </div>
            <span class="text-danger">@error('tp_number') {{ $message }} @enderror</span>
        </div>
    </div>

   


    <div class="row mb-2">
        <div class="col">
            <label for="InputPassword1" class="form-label">Create Password</label>
            <input type="password" class="form-control" id="signUpPass" placeholder="Create a Password"
                name="InputPassword1">
            <span class="text-danger">@error('Password') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="signUpPass2" placeholder="Confirm the Password"
                name="confirmPassword">
            <span class="text-danger">@error('confirmPassword') {{ $message }} @enderror</span>
        </div>
    </div>

    <div class="row mt-2">
        <div class="text-right">

                <!-- JavaScript to display the selected image -->

            <button type="submit" class="btn btn-primary btn-sm">ADD</button>
            <button type="button" onclick="clearForm()" class="btn btn-success btn-sm">CLEAR</button>
        </div>
    </div>

</form>
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
<script>
            const profilePictureInput = document.getElementById('profile_picture');
            const selectedImage = document.getElementById('selected_image');

            profilePictureInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        selectedImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            function clearForm() {
    document.getElementById("add_admin_form").reset();
  }
        </script>
    @endsection
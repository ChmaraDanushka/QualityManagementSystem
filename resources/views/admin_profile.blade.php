<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
  body {
    margin: 0;
    padding-top: 40px;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
}
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}


    </style>


</head>
<body>
<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
				<img src="{{ asset('uploads/admin_pro/' . (isset($admin[0]->user_profile_picture) ? $admin[0]->user_profile_picture : '')) }}" id="selected_image" alt="Image" title="Image Title" style="max-width: 100%; height: auto;">

					<!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin"> -->
				</div>
				<h5 class="user-name">{{ isset($admin[0]->user_first_name) ? $admin[0]->user_first_name : '' }} 
{{ isset($admin[0]->user_last_name) ? $admin[0]->user_last_name : '' }}</h5>
				<h6 class="user-email">{{ isset($admin[0]->user_email) ? $admin[0]->user_email : '' }}</h6>
			</div>
			<div class="about">
				<h5>About</h5>
				<p>A Quality Manager is a professional who ensures that all products within a company meet consistent standards. They develop and implement quality control tests to ensure the company’s result is what it should be, inspecting at various stages in production and writing reports on their findings to take action where needed.</p>
			</div>
		</div>
	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Personal Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="fullName">Full Name</label>
					<!-- admin_view.blade.php -->

<input type="text" class="form-control" id="fullName" placeholder="Enter full name" value="{{ isset($admin[0]->user_first_name) ? $admin[0]->user_first_name : '' }} 
{{ isset($admin[0]->user_last_name) ? $admin[0]->user_last_name : '' }}">

				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="eMail">Email</label>
					<input type="email" class="form-control" id="eMail" placeholder="Enter email ID" value="{{ isset($admin[0]->user_email) ? $admin[0]->user_email : '' }}">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" id="phone" placeholder="Enter phone number" value="{{ isset($admin[0]->user_tp) ? $admin[0]->user_tp : '' }}">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="website">User nic</label>
					<input type="url" class="form-control" id="website" placeholder="Website url" value="{{ isset($admin[0]->user_nic) ? $admin[0]->user_nic : '' }}">
				</div>
			</div>
		</div>
		
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
				<button type="button" id="submit" name="submit" class="btn btn-secondary" onclick="closeWindow()">Close</button>

<script>
  function closeWindow() {
    // Close the window or perform any other desired action
    window.close();
  }
</script>



				
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</body>
</html>

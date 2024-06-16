<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CRISTAL PACK QA SYSTEM :: Sign-In</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="{{asset('css/my.css')}}" rel="stylesheet">

 
</head>




<body class="body-gray" style="background-color:#add8e6;">
  


<form action="{{ route('login_qc') }}" method="POST" >



           
     @csrf 
            <!---->

          
<div class="gradient">
<div class ="container wr-company py-5">
<div id="loginPagecompany-logo">
    <img src="assets/img/cristal-pack.png" /></div>
      <h2>CRISTAL PACK PRIVET LIMITED</h2>
          <h6>Povide The Best Packing Products</h6>
          
          <div id="loginfssc-logo"><img src="assets/img/fssc.png" /></div>
          <div id="loginbureau-logo" class="bureau"><img src="assets/img/bureau.png" /></div><br>
          <br> <br> <br> <br>
          <h6>Crystal Pack (Pvt) Ltd
Rangala Road<br>
Teldeniya<br>
20900<br>
Sri Lanka</h6>
<h6>Tel: +94 812 375438 <br>
Fax: +9481-2376988
</h6> 
         <h6>Email: sales@crystalpack.net / crystal@crystalpack.net</h6>
     
</div>
  <div class="container wr-signIn py-5" >
   {{--  new use success  & fail message --}}
     @if (Session::has('success'))

     <div class="alert alert-success">{{Session::get('success')}} </div>
         
     @endif
   
     @if (Session::has('fail'))
     <div class="alert alert-danger">{{Session::get('fail')}} </div>
     @endif
   {{--  new use success  & fail message --}}
    <div class="row" >
      <div class="col text-center">
        <div id="loginPage-logo"><img src="assets/img/cristal-pack.png" /></div>
        <div class="mt-4">
          <h2>QC LOGIN</h2>
          <h6>Welcome back! Please enter your details.</h6>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col mx-auto">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email"  value="{{old('email')}}">
          <span class="text-danger">@error('email') {{$message }}@enderror</span>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" >
            <span class="text-danger">@error('password') {{$message }}@enderror</span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Remember me
            </label>
          </div>
        </div>
        {{-- <div class="col text-end"><a
            class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">Forgot password</a></div> --}}
      </div>
      <div class="row mt-4">
        <div class="col">
          <button type="submit" class="btn btn-primary w-100">Log In</button>
        </div>
      </div>
      </div>
      

    </div>
</div>


<!---->


  </form>



</body>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
   <!-- All Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab" >
	<meta name="robots" content="" >
	<meta name="keywords" content="school, school admin, education, academy, admin dashboard, college, college management, education management, institute, school management, school management system, student management, teacher management, university, university management" >
	<meta name="description" content="Discover Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard" >
	<meta property="og:title" content="Akademi : School and Education Management Admin Dashboard Template" >
	<meta property="og:description" content="Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard">
	<meta property="og:image" content="social-image.html" >
	<meta name="format-detection" content="telephone=no">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin GoldMate</title>


	<link rel="shortcut icon" type="image/png" href="images/favicon.png" >
	<link href="{{ asset('') }}assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link href="{{ asset('') }}assets/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="2x2" href="{{ asset('') }}assets/images/logo/IconWhite.png">

</head>

<body class="body h-100">
	<div class=" authincation d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="login-aside text-center d-flex flex-column flex-row-auto">
			<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
				<div class="text-center mb-lg-4 mb-2 pt-5 logo">
					<img class="w-75" src="{{ asset('') }}assets/images/logo/GoldMateWhite.png" alt="">
				</div>
				<h3 class="mb-2 text-white">Welcome back!</h3>
				<p class="mb-4">User Experience & Interface Design <br>Strategy SaaS Solutions</p>
			</div>
			<div class="aside-image position-relative" style="background-image:url(images/background/pic-2.png);">
				<img class="img1 move-1" src="images/background/pic3.png" alt="">
				<img class="img2 move-2" src="images/background/pic4.png" alt="">
				<img class="img3 move-3" src="images/background/pic5.png" alt="">

			</div>
		</div>
		<div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<div class="d-flex justify-content-center h-100 align-items-center">
				<div class="authincation-content style-2">
					<div class="row no-gutters">
						<div class="col-xl-12 tab-content">
							<div id="sign-up" class="auth-form tab-pane fade show active form-validation">
								<form action="{{ route('loginPost') }}" method="POST">
									<div class="text-center mb-4">
										<h3 class="text-center mb-2 text-black">Sign In</h3>
									</div>
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger solid alert-dismissible fade show">
                                            <svg viewBox="0 0 24 24" width="24 " height="24"
                                                stroke="currentColor" stroke-width="2" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                                <polygon
                                                    points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                                </polygon>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>
                                            <strong>Error!</strong> {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="btn-close"><span><i
                                                        class="fa-solid fa-xmark"></i></span>
                                            </button>
                                        </div>
                                    @endif
									<div class="sepertor">
										<span class="d-block mb-4 fs-13">with email</span>
									</div>
                                    @csrf
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Email address</label>
									  <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="hello@example.com">
									</div>
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Password</label>
									  <input type="password" name="password" class="form-control" id="exampleFormControlInput2" placeholder="Password">
									</div>
									<a href="javascript:void(0);" class="text-primary float-end mb-4">Forgot Password ?</a>
									<button class="btn btn-block btn-warning" type="submit">Sign In</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>

</body>

</html>

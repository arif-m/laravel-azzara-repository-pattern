<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('templates/dashboard/assets//img/bengkalis.png') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('templates/dashboard/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset("templates/dashboard/assets/css/fonts.css") }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('templates/dashboard/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('templates/dashboard/assets/css/azzara.min.css') }}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Backend - CMS</h3>
			<div class="login-form">
                @if(session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{session('error')}}
                </div>
                @endif
                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="form-group form-floating-label">
                        <input id="email" name="email" type="text" class="form-control input-border-bottom" required>
                        <label for="email" class="placeholder">Username</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
                        <label for="password" class="placeholder">Password</label>
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>
                    <div class="row form-sub m-0" style="display:none">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme">
                            <label class="custom-control-label" for="rememberme">Remember Me</label>
                        </div>
                        
                        <a href="#" class="link float-right">Forget Password ?</a>
                    </div>
                    <div class="form-action mb-3">
                        <button type="submit" class="btn btn-primary btn-rounded btn-block">Log In</button>
                    </div>
                    <div class="login-account" style="display:none">
                        <span class="msg">Don't have an account yet ?</span>
                        <a href="#" id="show-signup" class="link">Sign Up</a>
                    </div>
                </form>
			</div>
		</div>

		<div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up</h3>
			<div class="login-form">
                @if(session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{session('error')}}
                </div>
                @endif
                <form method="POST" action="{{ route('post.register') }}">
                    @csrf
                    <div class="form-group form-floating-label">
                        <input  id="name" name="name" type="text" class="form-control input-border-bottom" required>
                        <label for="name" class="placeholder">Fullname</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input  id="email" name="email" type="email" class="form-control input-border-bottom" required>
                        <label for="email" class="placeholder">Email</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input  id="passwordsignin" name="passwordsignin" type="password" class="form-control input-border-bottom" required>
                        <label for="passwordsignin" class="placeholder">Password</label>
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>
                    <div class="form-group form-floating-label">
                        <input  id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom" required>
                        <label for="confirmpassword" class="placeholder">Confirm Password</label>
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>
                    <div class="row form-sub m-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="agree" id="agree">
                            <label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
                        </div>
                    </div>
                    <div class="form-action">
                        <a href="#" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
                        <!--<a href="#" class="btn btn-primary btn-rounded btn-login">Sign Up</a>-->
                        <button type="submit" class="btn btn-primary btn-rounded btn-login">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
			</div>
		</div>
	</div>
	<script src="{{ asset('templates/dashboard/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('templates/dashboard/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('templates/dashboard/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('templates/dashboard/assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('templates/dashboard/assets/js/ready.js') }}"></script>
</body>
</html>
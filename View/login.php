<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Login :: NSE </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo ('assets/'); ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo ('assets/'); ?>css/font-awesome.css">
	<!-- <link rel="stylesheet" href="<?php echo ('assets/'); ?>css/ionicons.css"> -->
	<link rel="stylesheet" href="<?php echo ('assets/'); ?>css/AdminLTE.css">
	<link rel="stylesheet" href="<?php echo ('assets/'); ?>css/checkbox.css">
	<!-- <link rel="stylesheet" href="css/plugins/iCheck/square/blue.css"> -->
	<link rel="shortcut icon" href="<?= ('assets/images/logo.png') ?>" />
	<style type="text/css">
		.btn-success:hover,
		.btn-success:active,
		.btn-success.hover {
			background-color: #234ba0;
			border-color: #234ba0 !important;
		}

		.btn-primary.focus,
		.btn-primary:focus {
			border-color: #234ba0 !important;
			background-color: #234ba0 !important;
		}

		a:hover,
		a:active,
		a:focus {
			color: #8e5e09 !important;
		}

		a {
			color: #d3901a !important;
		}

		.btn-success:focus {
			border-color: #234ba0 !important;
			background-color: #234ba0 !important;
		}

		.btn-block {
			border-color: #010101 !important;
			background-color: #010101 !important;
		}

		.btn:hover,
		.btn:active,
		.btn:focus {
			color: white !important;
		}

		.text-login {
			padding: 300px 50px 0px;
		}

		.text-login p {
			font-size: 14px;
		}

		html,
		body {
			height: 100%;
		}
	</style>


</head>

<body class="hold-transition login-page">
	<section class="login-block">
		<div class="container">
			<form id="login-form" method="post">
				<div class="row">
					<div class="col-md-4 login-sec">
						<div class="text-center">
							<img src="assets/images/logo.png" width="60%">
						</div>
						<h1 class="text-center"><b>User Login</b></h1>

						<div id="DisplayMessage"></div>
                        <div class="form-group">
							<label for="UserName" class="text-uppercase">User</label>
							
							<input type="text" name="UserName" id="UserName" class="form-control" placeholder="Enter name"  >

						</div>
                        <div class="form-group">
							<label for="UserMobile" class="text-uppercase">Mobile</label>
							
							<input type="text" name="UserMobile" id="UserMobile" class="form-control" placeholder="Enter mobile"  >

						</div>
						<div class="form-group">
							<label for="email" class="text-uppercase">Email</label>
							
							<input type="email" name="UserEmail" id="UserEmail" class="form-control" placeholder="Enter email"  >

						</div>

						<div class="form-group">
							<label for="password" class="text-uppercase">Password</label>
							
							<input type="password" name="UserPassword" id="UserPassword" class="form-control" placeholder="Enter password" >
						</div>


						
						<button type="submit" class="btn btn-login float-right btn-block">Login</button>


					</div>
					<div class="col-md-8 banner-sec">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="text-center">

								<div class="text-login">
									<p>
                                    <b>Introducing NEC Software Solutions</b><br>
                                    We build software and services that help keep people safer, healthier, and better connected worldwide. Our purpose is to help change lives every day. We help improve the services that matter the most. We are in our customers’ world, and together, we make a difference.
									</p>
								</div>
							</div>
							<div class="text-center" style="margin-top: 30px;">
								<p>Copyright © <?php echo date('Y'); ?> <a href="#"><?= 'https://www.necsws.com' ?></a>. All rights reserved.</p>
							</div>


						</div>
					</div>
				</div>
			</form>

		</div>
	</section>
	<!-- /.login-box -->
	<!-- jQuery 2.2.3 -->
	<script type="text/javascript" src="<?php echo ('assets/'); ?>js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?php echo ('assets/'); ?>js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$(document).on('submit', '#login-form', function(Event) {
				Event.preventDefault();
				let $this = $(this);
				let $spinner = '<i class="fa fa-spinner fa-spin"></i>';
				let $submitButton = $this.find('button[type=submit]');

				$.ajax({
					url: '<?php echo ('../Controller/LoginController.php/login'); ?>',
					type: 'POST',
					data: $this.serialize(),
					dataType: 'JSON',
					beforeSend: function() {
						$submitButton.html($spinner);
					},
					success: function(LoginData) {
						if (LoginData.Success == true) {
							setTimeout(() => {
								window.location.href = "<?php echo ('success.php'); ?>";
							}, 1000);
						} else {
                            setTimeout(() => {
								window.location.href = "<?php echo ('failed.php'); ?>";
							}, 1000);
						}
					}
				});
			});
		});
	</script>
</body>

</html>
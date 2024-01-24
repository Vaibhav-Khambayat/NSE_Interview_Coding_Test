<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Login :: NSE </title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" href="assets/css/AdminLTE.css">
	<link rel="stylesheet" href="assets/css/checkbox.css">
	<link rel="shortcut icon" href="assets/images/logo.png" />
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
			<form id="registration-form" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4 login-sec d-flex flex-column">
						<h2 class="text-center" style="margin-top: -40px;">User Registration</h2>
						<div id="DisplayMessage"></div>
						<div class="form-group">
							<label for="UserName" class="text-uppercase">Name</label>
							<input type="text" name="UserName" id="UserName" class="form-control" placeholder="Enter name">
						</div>
						<div class="form-group">
							<label for="UserMobile" class="text-uppercase">Mobile</label>
							<input type="text" name="UserMobile" id="UserMobile" class="form-control" maxlength="10" placeholder="Enter mobile">
						</div>
						<div class="form-group">
							<label for="UserEmail" class="text-uppercase">Email</label>
							<input type="email" name="UserEmail" id="UserEmail" class="form-control" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="UserPassword" class="text-uppercase">Password</label>
							<input type="password" name="UserPassword" id="UserPassword" class="form-control" placeholder="Enter password">
						</div>
						<div class="form-group text-center">
							<label for="File" style="cursor: pointer;">
								<img src="assets/images/upload.png" width="65" class="picture-image">
							</label>
							<input type="file" class="form-control" name="File" id="File" autocomplete="off" style="display: none;">
						</div>
						<button type="submit" class="btn btn-login float-right btn-block">Register</button>
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
								<p>Copyright © <?php echo date('Y'); ?> <a href="#">https://www.necsws.com</a>. All rights reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
	<script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".picture-image").click(() => {
				$("#File").trigger('click');
			});

			$(document).on('click', '.cancel-user-img', function (event) {
				var path = 'assets/images/upload.png';
				$(".picture-image").attr("src", path);
				$(".picture-image").removeClass('cancel');
				$(this).closest(".col-md-12").find('br').remove();
				$("#File").val('');
				$(this).remove();
			});

			$(document).on('change', "#File", function () {
				var imgPath = $(this)[0].value;
				var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
				if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
					if (typeof (FileReader) != "undefined") {
						var reader = new FileReader();
						reader.onload = function (e) {
							$(".picture-image").attr("src", e.target.result);
						}
						reader.readAsDataURL($(this)[0].files[0]);
						if (!$(".picture-image").hasClass('cancel')) {
							$(".picture-image").after('<br /><a href="javascript:void(0)" class="cancel-user-img btn btn-danger"> Cancel Image </a>');
							$(".picture-image").addClass('cancel');
						}
					} else {
						alert("This browser does not support FileReader.");
					}
				} else {
					alert("Please select only images");
				}
			});

			$(document).on('submit', '#registration-form', function (event) {
				event.preventDefault();
				let $this = $(this);
				let $spinner = '<i class="fa fa-spinner fa-spin"></i>';
				let $submitButton = $this.find('button[type=submit]');

				$.ajax({
					url: '<?php echo ('../Controller/RegisterController.php/register'); ?>',
					type: 'POST',
					data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
					beforeSend: function () {
						$submitButton.html($spinner);
					},
					success: function (RegisterData) {
						if (RegisterData.Success == true) {
							setTimeout(() => {
								window.location.href = "login.php";
							}, 1000);
						} else {
							setTimeout(() => {
								window.location.href = "registrationfailed.php";
							}, 1000);
						}
					}
				});
			});
		});
	</script>
</body>

</html>

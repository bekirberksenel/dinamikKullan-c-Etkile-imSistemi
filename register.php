<?php
session_start();

if (isset($_SESSION['user_session']) != "") {
    header("Location: home.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HW</title>
<link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png"></link>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"></link>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"	media="screen"></link>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css"	media="screen"></link>
</head>

<body>
	<div class="signin-form">
		<div class="container">
			<form class="form-signin" method="post" id="register-form">

				<h2 class="form-signin-heading">Kullanıcı Kayıt Ekranı</h2>
				<hr />
				
				<div id="error"></div>

				<div class="form-group">
					<input type="text" class="form-control" placeholder="Adı" name="name" id="name" />
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Soyadı" name="surname" id="surname" />
				</div>

				<div class="form-group">
					<input type="email" class="form-control" placeholder="Email adresi"	name="user_email" id="user_email" /> 
					<span id="check-e"></span>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Şifresi" name="password" id="password" />
				</div>

				<hr />

				<div class="form-group">
					<button type="submit" class="btn btn-default" name="btn-register" id="btn-register">
						<span class="glyphicon glyphicon-log-in"></span> &nbsp; Kayıt Ol
					</button>
				</div>
			</form>
		</div>
	</div>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
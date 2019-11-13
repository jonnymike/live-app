<?php
include('login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
	header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login </title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
<body>
<div id="main">
	<div id="login">
		<h2>Login Management</h2>
		<form action="" method="post" class="login_form">
			<input id="name" name="username" placeholder="Username" type="text">
			<input id="password" name="password" placeholder="Password" type="password">
			<input name="submit" type="submit" class="button" value="Login "align="center">
			</br>
		<span><?php echo $error; ?></span>
		</form>
	</div>
</div>
</body>
</html>

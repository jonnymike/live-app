<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
<body>
	<div id="profile">
		<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
		<b id="logout"><a href="logout.php">Log Out</a></b>
	</div>
	<div id="profile_main">
		<h3>1. <a href="create-poll.php">Create New Question</a></h3>
		<h3>2. <a href="show-poll.php">Show all Poll Questions</a></h3>
	</div>
</body>
</html>

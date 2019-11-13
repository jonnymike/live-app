<?php
include('session.php');

if(isset($_POST['submit'])){
	
	$q_name= pg_escape_string($_POST['question_name']);
	$count_code= pg_escape_string($_POST['count_number']);	
	$desc= pg_escape_string($_POST['que_desc']);
	
	include 'config.php';	

	$select = 'Select * from vote where vote."Question" = \''.$q_name.'\'';
	
	$result = pg_query($select) or die('Query failed: ' . pg_last_error());
	
	if ($row = pg_num_rows($result) == 1)
	{	
		$message = "This Question is already exist ";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	else
	{
		$sql = 'INSERT INTO vote ("Question", "Count_num", "Quest_Desc") VALUES (\''.$q_name.'\',\''.$count_code.'\', \''.$desc.'\')';
	$insert_result = pg_query($sql) or die('Query failed: ' . pg_last_error());	
		if ($insert_result)
		{	
			echo '<script type="text/javascript">'; 
			echo 'alert("New Question Created successfully");'; 
			echo 'window.location.href = "https://poll-upvoting.herokuapp.com/admin/show-poll.php";';
			echo '</script>';	
		}
	}
}
?> 
<!DOCTYPE html>
<html>
	<head>
		<title>New Poll Question</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
<body>
	<div id="profile">
		<b id="welcome"><a href="profile.php">Back to Home</a></b>
		<b id="logout"><a href="logout.php">Log Out</a></b>
	</div>
	<div class="code_create">
		<form action="" method="POST">
			<input id="d_name" name="question_name" type="text" placeholder="Question" required >
			<input id="ref_code" name="count_number" type="text" placeholder="Counts" required>
			<input id="sal_rep" name="que_desc" type="text" placeholder="Question Desc" required>
			<input name="submit" type="submit" value="Create" id="create">
			<span><?php echo $error; ?></span>
		</form>
	</div>
</body>
</html>
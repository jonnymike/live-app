<?php
include 'config.php';

if(isset($_POST['Submit'])){
	
	$id= pg_escape_string($_POST['Id']);	
	$que= pg_escape_string($_POST['question_name']);
	$cunt= pg_escape_string($_POST['count_number']);
	$dsc= pg_escape_string($_POST['que_desc']);

	$sql = 'UPDATE vote SET "Question"= \''.$que.'\', "Count_num"= \''.$cunt.'\', "Quest_Desc"= \''.$dsc.'\' where vote."Id" = \''.$id.'\'';
	
	$result_update = pg_query($sql) or die('Query failed: ' . pg_last_error());

    if($result_update)
	{
		echo '<script type="text/javascript">'; 
        echo 'alert("Update successfully");'; 
        echo 'window.location.href = "http://poll-upvoting.herokuapp.com/admin/profile.php";';
        echo '</script>';
	}
	else
	{
		$message = "Update unsuccessful ";
	echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
if(isset($_GET['id']))
{
	$id= pg_escape_string($_GET['id']);
	
	$query = 'SELECT * from vote where vote."Id" = \''.$id.'\'';
	
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());	
	
	// output data of each row
	while($row = pg_fetch_array($result)) {
		$id= $row["Id"];
		$a= $row["Question"];
		$b= $row["Count_num"];
		$d= $row["Quest_Desc"];
	}
}	
?>
<html>
	<head>
		<title>Poll Questions</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
<body>
<div id="profile">
		<b id="welcome"><a href="profile.php">Back to Home</a></b>
		<b id="logout"><a href="logout.php">Log Out</a></b>
	</div>
	<div id="code">
		<h3 align="center"><u><a href="create-poll.php"<button class="button">Create New Question</button></a></u></h3>
	</div>

		<div class="code_update">
			<form method="post" name="update" action="" /> 
				<input type="hidden" name="Id" value="<?php echo($id); ?>">             
				<input type="text" name="question_name" placeholder="Question Name" value="<?php echo($a); ?>"/></br>  
				<input type="text" name="count_number" placeholder="Counts" value="<?php echo($b); ?>"/></br>
				<input type="text" name="que_desc" placeholder="Question Desc" value="<?php echo($d); ?>"/></br>
				<input style="padding: 10px 60px;" type="submit" name="Submit" value="Update"/> 
			</form> 
		</div>	
</body>
</html>		

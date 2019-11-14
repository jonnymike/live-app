<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vote System</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> 
	<script type="text/javascript" src="myvote.js"></script>
</head>
<body>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main">
		<div class="container">
			<div class="heading">
				<h1>Vote on Upcoming Features</h1>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_main">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content">
<?php
// Connecting, selecting database
$dbconn = pg_connect("host=ec2-23-23-223-2.compute-1.amazonaws.com dbname=d1filjgshltm5 user=mtracxsevywyhp password=d1950f8ce89de40987a180f56de2bc99250da5810e346b57e6bdf5e957c18c3c")
    or die('Could not connect: ' . pg_last_error());
	
$query = 'SELECT * from vote ORDER BY vote."Id" limit 5';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());	

// Printing results in HTML
while ($row = pg_fetch_array($result)) {
	//echo $row[Count_num];
	//echo '<pre>';
	//print_r ($row);


?>
				<div class="list">
					<div class="toggle">
						<div class="total">
							<span class="icon"><img src="images\arrow.png"> </span>
							<span class="number" id="<?php echo $row['Id']?>"><?php echo $row['Count_num'];?></span>
						</div>
					</div>
					<div class="list_innr">
						<h2><?php echo $row['Question']?></h2>
						<p><?php echo $row['Quest_Desc']?></p>
					</div>	
				</div>
<?php
}
// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
					<p class="email">© 2019&nbsp;<a href="#">Live-View</a>&nbsp;All Rights Reserved.</p>
				</div>
			</div>	
		</div>
	</div>
	<div class="footer">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main">
			<div class="container">
			<div class="col-md-4"></div>
			</div>
		</div>
	</div>
</body>
</html>

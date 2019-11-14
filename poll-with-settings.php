<?php
include 'config.php';

// Getting Poll Settings Options Data
	$p_id= 2;
	
	$query = 'SELECT * from poll_setting where poll_setting."Poll_id" = \''.$p_id.'\'';
	
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());	
	
	// output data of each row
	while($row = pg_fetch_array($result)) {
		$id= $row["Poll_id"];
		$a= $row["Logo_Path"];
		$b= $row["Poll_Title"];
		$c= $row["Page_Bg_Color"];
		$d= $row["Poll_Bg_Color"];
		$e= $row["Poll_Title_Color"];
		$f= $row["Poll_Item_Color"];
		$g= $row["Description_Color"];
		$h= $row["Count_BG_Color"];
		$i= $row["Count_Text_Color"];		
		$j= $row["Status_Option"];		
		$k= $row["Custom_Javascript"];	
		$l= $row["Active_Count_BG"];
		$m= $row["User_Request"];		
		$n= $row["Publish_Option"];		
		$o= $row["Suggest_Email"];		
	}

// Send Suggestion Box Data into Database
if(isset($_POST['submit'])){
	
	$p_id= 2;
	$count_code=0;
	
	$sug_title = pg_escape_string($_POST['sugges_title']);
	$sug_desc = pg_escape_string($_POST['sugges_desc']);
	
	if ($n == Publish) {
	
	$insert = 'INSERT INTO vote ("Question", "Count_num", "Quest_Desc","poll_id") VALUES (\''.$sug_title.'\',\''.$count_code.'\',\''.$sug_desc.'\',\''.$p_id.'\')';
	$insert_result = pg_query($insert) or die('Query failed: ' . pg_last_error());
	} 
	
	//Send Email to Poll Admin
	require 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->isHTML(true);
	$mail->Host = '';                     // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '';   // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

	$mail->From = 'support@mailgun.net';
	$mail->FromName = 'Mailer';
	$mail->addAddress($o);                 // Add a recipient

	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

	$mail->Subject = 'Poll Request';
	$mail->Body    = '<h3>A new request has been submitted for '.$b.'.</h3> 
					<h3>Details are below : <br />
					Item Title : '.$sug_title. '<br />
					Item Description : '.$sug_desc.'</h3>';

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo 'Message has been sent';
	}

}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vote System</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="myvote.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="jquery.twbsPagination.js"></script>
<style type="text/css">
#show-image {
    float: left;
}
#poll_status {
    color: #fff;
    float: right;
}
.total.toggled {
    background: <?php echo($l);?>!important;
    border-color: <?php echo($l);?>!important;;
}
#suggestion_form {
    background: #d9edf7 none repeat scroll 0 0;
	border-radius: 5px;
	margin-top: 20px;
}
#sugges_btn {
	cursor: pointer;
	display:table;
	width:100%;
    background-image: url(http://app.upvoteapp.com/images/arrow_drop.png);
    background-position: center right;
	background-repeat: no-repeat;
	padding: 10px;
}
#show_status {
    display: none;
}
</style>
<script type="text/javascript">
<?php echo $k; ?>;
$(document).ready(function() {
	$('#pagination-demo').twbsPagination({
		totalPages: 1,
	});
});

$(document).ready(function() {
	var my_req = "<?php echo $m; ?>";
	if (my_req == 'Yes'){
		$('#suggestion_form').show();
	}
	$('#sugges_btn').click(function() {
		$('#suggestion_form form').show();
		$(this).hide();
	});	
});
</script>	
</head>
<body style="background-color:<?php echo($c);?>!important;">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main">
		<div class="container">
			<!-- Show Logo -->
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div id="show-image">
					<img src="images\Shopified_App_Logo.png" style="width: 100%;">
					<!--img src="http://app.upvoteapp.com/poll-admin/eliteadmin-horizontal-nav-fullwidth/<!?php echo ($a); ?>" style="width: 100%;"-->
				</div>	
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div id="poll_status">
					<h3></h3>
				</div>
			</div>
			<!-- Suggestion Form -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="suggestion_form" style="display:none">
				<form method="POST" action="" style="display:none; padding: 10px;">
					<h3>Post Your Suggestion Here : </h3>
					<div class="form-group">
					  <input type="text" class="form-control" name="sugges_title" required id="" placeholder="Item Title">
					</div>
					<div class="form-group">
					  <textarea class="form-control" name="sugges_desc" required id="" placeholder="Item Description"></textarea>
					</div>
					<center><input class="btn btn-default" type="submit" name="submit" value="Make Suggestion"></center>
				</form>
				<div id="sugges_btn"><h3>Make a suggestion</h3></div>
			</div>			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="heading">
					<h1 style="color:<?php echo ($e);?>;"><?php echo ($b);?></h1>
				</div>
			</div>	
			<div style="background-color:<?php echo($d);?>!important;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_main">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content">
<?php
include 'config.php';

$poll= 2;
	
$query = 'SELECT * from vote where vote."poll_id" = \''.$poll.'\' ORDER BY vote."Id"';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());	

// Printing results in HTML
while ($row = pg_fetch_array($result)) {
	//echo $row[Count_num];
	//echo '<pre>';
	//print_r ($row);
?>
				<div class="list">
					<div id="show_status" style="display:<?php echo $row['Item_Response'];?>"><p><?php echo $row['Item_Status']?></p></div>
					<div class="toggle">
						<div class="total" style="background-color:<?php echo($h);?>;">
							<span class="icon"><img src="images\arrow.png"> </span>
							<span class="number" id="<?php echo $row['Id']?>" style="color:<?php echo ($i);?>;"><?php echo $row['Count_num'];?></span>
						</div>
					</div>
					<div class="list_innr">
						<h2 style="color:<?php echo ($f);?>;"><?php echo $row['Question']?></h2>
						<p style="color:<?php echo ($g);?>;"><?php echo $row['Quest_Desc']?></p>
					</div>	
				</div>
<?php
}
?>
				<center><ul id="pagination-demo" class="pagination-lg"></ul></center>
					<p class="email">Email:&nbsp;<a href="#">abc@gmail.com</a>&nbsp;enter your account</p>
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

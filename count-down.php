<?php
// Connecting, selecting database
$dbconn = pg_connect("host=ec2-23-23-223-2.compute-1.amazonaws.com dbname=d1filjgshltm5 user=mtracxsevywyhp password=d1950f8ce89de40987a180f56de2bc99250da5810e346b57e6bdf5e957c18c3c")
    or die('Could not connect: ' . pg_last_error());

// Getting data from Ajax Request
$ques_id = pg_escape_string($_GET['votecode']);

// SQL query 
$query_update = 'UPDATE vote SET "Count_num" = "Count_num"-1 where vote."Id" = \''.$ques_id.'\'';

$result_one = pg_query($query_update) or die('Query failed: ' . pg_last_error());

$query = 'SELECT vote."Count_num" from vote where vote."Id" = \''.$ques_id.'\'';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	
// Printing results in HTML
while ($row = pg_fetch_array($result)) {
     //do stuff with $row
	echo $row[0];
	//echo "<br />\n";
}

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>

<?php
session_start();
header("Cache-control: private"); 
@include("function.php");
if (!check()) { 
 	header("Location: index.htm");
	session_destroy();
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function doSubmit() {
if (document.res.sid.value=="") {
	alert("Enter Student ID");
	return false;
	}
	return true;
}
</script>
</head>
<body>
<form action="result2.php" method="post" name="res">
Student ID: <input type="text" name="sid">
<input type="submit" value="View" onClick="return doSubmit()">
</form>
<?php
if (isset($_POST['sid'])) {
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select qcode,sid,sname,time,marks from result where sid like '%".$_POST['sid']."%' order by time", $conn);
	if (mysql_errno())
		echo mysql_error();
	print "Number of Examinations: ".mysql_num_rows($result)." for ".$_POST['sid'];
	print "<table border=\"1\">";
	print "<tr><td>Paper</td><td>Student ID</td><td>Name</td><td>Date & Time</td><td>Marks</td></tr>";
	while ($name_row = mysql_fetch_row($result)) {
	  echo "<tr><td>".$name_row[0]."</td><td>".$name_row[1]."</td><td>".$name_row[2]."</td><td>".$name_row[3]."</td><td>".$name_row[4]."</td></tr>";
	}
	print "</table>";
}	
?>
</body>
</html>

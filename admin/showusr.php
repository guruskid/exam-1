<?php
session_start();
header("Cache-control: private"); 
@include("function.php");
if (!check()) { 
 	header("Location: admin.htm");
	session_destroy();
	exit;
}
else {
	if(isset($_SESSION['uname']) && $_SESSION['uname']!="root") {
		header("Location: admin.htm");
		session_destroy();
		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body> 
<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select uname,fname from user", $conn);
	print "Number of Users are: ".mysql_num_rows($result);
	print "<br><br><hr width=\"50%\"><table BORDER=1 align=\"center\">";
	print "<tr><td><B>User ID</B></td><td><B>Name</B></td></tr>";
	while ($name_row = mysql_fetch_row($result)) {
	  echo "<TR>";
	  echo "<TD>".$name_row[0]."</TD>";
	  echo "<TD>".$name_row[1]."</TD>";
      echo "</TR>";
	}
	print "</table><hr width=\"50%\">";			
	mysql_close($conn);	
?> 
</body>
</html>

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
<script language="javascript">
function doSubmit() {
if (document.res.paper.value=="") {
	alert("Choose Question Paper");
	return false;
	}
	return true;
}
</script>
</head>
<body>
<form action="delresult.php" method="post" name="res">
<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select distinct qcode from result", $conn);
	print "<strong>Choose Question Paper:  </strong>";
	print "<select size=\"1\" name=\"paper\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]."</option>";
    }
	print "</select>";
	mysql_close();
?>
<input type="submit" value="Delete" onClick="return doSubmit()">
</form>
<?php
if (isset($_POST['paper'])) {
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("delete from result where qcode='".$_POST['paper']."'", $conn);
	if (!mysql_affected_rows())
		echo "<font color=\"#FF0000\">Error...<br></font>";
	else 
		print "Sucessfully deleted ".$_POST['paper']." from result.";
}	
?>
</body>
</html>

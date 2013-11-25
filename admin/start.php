<?php
session_start();
header("Cache-control: private");
@include("function.php");
if (!check()) { 
 	header("Location: index.htm");
	session_destroy();
	exit;
}
$ppp=<<<EndCode
<script language="JavaScript">
function doSubmit() {
	if (document.sta.tbl.value=="") {
		alert("Enter Question Paper");
		return false;
		}
	return true;
}
</script>
EndCode;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
	if (!isset($_POST['tbl'])) 
	{
	print $ppp;
	print "<form action=\"start.php\" method=\"post\" name=\"sta\">";
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select qcode from pques", $conn);
	print "<select size=\"1\" name=\"tbl\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]."</option>";
    }
	print "</select>";
	print "<input type=\"submit\" value=\"Start\" onClick=\"return doSubmit()\">";
	print "</form>";
	$result = mysql_query("select * from running", $conn);
	print "Number of exams running are: ".mysql_num_rows($result)."<br>";
	print "<table border=\"1\">";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<tr><td>".$name_row[0]."</td><tr>";
    }
	print "</table>";
	mysql_close($conn);
	}
	else {
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("insert into running values ('".$_POST['tbl']."')", $conn);
		if (mysql_errno())
		{
			print "<font color=\"#FF0000\">Error...<br></font>".mysql_error();
		}
		else {
			print "Successfully Started ".$_POST['tbl'];
		}
	}
?>
</body>
</html>

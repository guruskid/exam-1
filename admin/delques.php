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
<script language="javascript">
function doSubmit() {
if (document.my.tbl.value=="" || document.my.qid.value=="") {
	alert("Enter valid data.");
	return false;
	}
	return true;
}
</script>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="delques.php" method="post" name="my">
Subject: 
<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select tname,tinfo from info where ttype='subject'", $conn);
	print "<select size=\"1\" name=\"tbl\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]." -> ".$name_row[1]."</option>";
    }
	print "</select>";
	mysql_close($conn);
?>
<br>Question ID: 
<input type="text" name="qid">
<input type="submit" value="Delete" onClick="return doSubmit()">
</form>
<?php
		if (isset($_POST['tbl'],$_POST['qid'])) {
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("delete from ".$_POST['tbl']." where qid='".$_POST['qid']."'",$conn);
		if (mysql_affected_rows($conn)) {
			print "Successfully Deleted from <br>".$_POST['tbl'];
		}
		else {
			print "<font color=\"#FF0000\">Error Deleting from ".$_POST['tbl']."<br>".mysql_error();
			print "</font>";
		}
		mysql_close($conn);
	}
?>
</body>
</html>

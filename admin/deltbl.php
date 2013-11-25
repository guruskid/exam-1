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
$ppp=<<<EndCode
<form action="deltbl.php" name="tdel" method="POST">
<script language="JavaScript">
function doSubmit() {
if (document.tdel.dtbl.value=="") {
	alert("Enter Valid Subject Name");
	return false;
	}
document.tdel.submit();
}
</script>
  Subject: <input type="text" name="dtbl" size="22">
  <input type="hidden" name="val" value="1">
  <input type="submit" value="Delete" onClick="return doSubmit()">
</form>
EndCode;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	if (isset($_POST['dtbl']) && $_POST['val']==1) {
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("delete from info where tname='".$_POST['dtbl']."'");
		$sta1=mysql_errno();
		$result = mysql_query("drop table ".$_POST['dtbl']."", $conn);
		if (!mysql_errno() && !$sta1) {
				print "Successfully Deleted <br>".$_POST['dtbl'];
		}
		else {
			print "<font color=\"#FF0000\">Error Deleting Subject: ".$_POST['dtbl']."<br>".mysql_error();
		}
		mysql_close($conn);
	}
	else {
		print $ppp;
	}
?> 
</body>
</html>

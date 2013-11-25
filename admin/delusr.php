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
<form action="delusr.php" name="del" method="POST">
<script language="JavaScript">
function doSubmit() {
if (document.del.dusr.value=="") {
	alert("Enter Valid User ID");
	return false;
	}
document.del.submit();
}
</script>
  User ID: <input type="text" name="dusr" size="22">
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
	if (isset($_POST['dusr']) && $_POST['val']==1) {
		if ($_POST['dusr']=="root" || $_POST['dusr']=="universal") {
			print "<font color=\"#FF0000\">The User Can't be Deleted!!!</font></body></html>";
			exit;		
		}
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("delete from user where uname='".$_POST['dusr']."'");
		if (mysql_affected_rows($conn)) {
				print "User Successfully Deleted <br>".$_POST['dusr'];
		}
		else {
			print "<font color=\"#FF0000\">Error Deleting User: ".$_POST['dusr']."<br>".mysql_error();
		}
		mysql_close($conn);
	}
	else {
		print $ppp;
	}
?> 
</body>
</html>

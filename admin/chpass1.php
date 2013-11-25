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
<form action="chpass1.php" name="chp" method="POST">
<script language="JavaScript">
function doSubmit() {
if (document.chp.cpasswd1.value=="" || document.chp.opasswd.value=="") {
	alert("Enter Valid User ID");
	return false;
	}
else if (document.chp.cpasswd1.value!=document.chp.cpasswd2.value) {
	alert("Passwords do not match");
	return false;
	}
else {
	document.chp.submit();
	}
}
</script>
  <table border="1" width="326">
    <tr>
      <td width="147">Old Password</td>
      <td width="166"> 
      <input type="password" name="opasswd" size="24" maxlength="10"></td>
    </tr>
	<tr>
      <td width="147">New Password</td>
      <td width="166"> 
      <input type="password" name="cpasswd1" size="24" maxlength="10"></td>
    </tr>
    <tr>
      <td width="147">Confirm Password</td>
      <td width="166"> 
      <input type="password" name="cpasswd2" size="24" maxlength="10"></td>
    </tr>
</table>
  <input type="hidden" name="val" value="1">
  <input type="submit" value="Change" onClick="return doSubmit()"> 
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
// Change password for users
	if (isset($_POST['cpasswd1']) && $_POST['val']==1) {
		if ($_SESSION['passwd']!=$_POST['opasswd']) {
			print "<font color=\"#FF0000\">Old Password does not match.</font></body></html>";
			exit;		
		}
		if ($_SESSION['uname']=="root" || $_SESSION['uname']=="universal") {
			print "<font color=\"#FF0000\">The password Can't be Changed!!!</font></body></html>";
			exit;		
		}
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("update user set password=password('".$_POST['cpasswd1']."') where uname='".$_SESSION['uname']."'");
		if (!mysql_errno()) {
				print "Password Successfully Changed for <br>".$_SESSION['uname'];
		}
		else {
			print "<font color=\"#FF0000\">Error Changing Password for User: ".$_SESSION['uname']."<br>".mysql_error();
		}
		$_SESSION['passwd']=$_POST['cpasswd1'];
		mysql_close($conn);
	}
	else {
		print $ppp;
	}
?> 
</body>
</html>

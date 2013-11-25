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
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function doSubmit() {
if (document.add.auname.value=="" || document.add.afname.value=="" ||
	document.add.apasswd1.value=="" || document.add.apasswd2.value=="" ) {
	alert("Enter Valid Data.");
	return false;
	}
else if (document.add.apasswd1.value!=document.add.apasswd2.value) {
	alert("Passwords do not match");
	return false;
	}
else {
	document.add.submit();
	}
}
</script>
</head>

<body>
<center>
<form action="addusr.php" method="post" name="add">
<table border="0" width="350">
  <tr>
    <td width="129">User name: </td>
    <td width="211"><input type="text" name="auname" size="29" maxlength="15"></td>
  </tr>
  <tr>
    <td width="129">Name:</td>
    <td width="211"><input type="text" name="afname" size="29" maxlength="30"></td>
  </tr>
  <tr>
    <td width="129">Password:</td>
    <td width="211"><input type="password" name="apasswd1" size="29" maxlength="10"></td>
  </tr>
  <tr>
    <td width="129">Confirm Password:</td>
    <td width="211"><input type="password" name="apasswd2" size="29" maxlength="10"></td>
  </tr>
</table>
<br>
<input type="submit" value="Add User" onClick="return doSubmit()">
<input type="hidden" name="val" value="1">
</form>
</center>

</body>
</html>
EndCode;
?>
<?php
// Only administator can run. To add a user.
if (isset($_POST['val']) && $_POST['val']==1) {
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	mysql_query("insert into user values ('".$_POST['auname']."','".$_POST['afname']."',password('".$_POST['apasswd1']."'))");
	if (!mysql_errno()) {
		print "<html><head><link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"></head>";
		print "User Successfully Added <br>".$_POST['auname'];
		print "<br><a href=\"showusr.php\">Show Users</a></html>";
	}
	else {
		print "<html><font color=\"#FF0000\">Error Adding User: ".$_POST['auname']."<br>".mysql_error();
		print "<br>MAY BE THE USER EXISTS TRY ANOTHER</font></html>";
	}
	mysql_close($conn);
}
else
	print $ppp;			
?>
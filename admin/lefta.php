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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="177" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="173"><span class="style1"><a href="make.php" target="main">View the system</a></span></td>
  </tr>
</table>
<table border="0" width="179">
  <tr>
    <td colspan="2">User Management</td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="143"><a href="addusr.php" target="main">Add User</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="143"><a href="showusr.php" target="main">Show Users</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="143"><a href="delusr.php" target="main">Delete User</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="143"><a href="chpass.php" target="main">Reset Password</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="chrpass.php" target="main">Root Password</a> </td>
  </tr>
</table>
<table border="0" width="177">
  <tr>
    <td width="171" colspan="2">Subjects</td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="141"><a href="addsub.php" target="main">Create Subject</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="141"><a href="showtbl.php" target="main">Show Subjects</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="141"><a href="deltbl.php" target="main">Delete Subject</a></td>
  </tr>
</table>
<table width="222" border="0">
  <tr>
    <td colspan="2">Questions</td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td width="180"><a href="showques.php" target="main">Show question bank</a> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="delques.php" target="main">Delete Question</a></td>
  </tr>
</table>
<a href="showpaper.php" target="main">Show Question Paper </a><br>
<a href="delpaper.php" target="main">Delete Question Paper</a> <br>
<table width="177" border="0">
  <tr>
    <td colspan="2">Result</td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td width="135"><a href="delresult.php" target="main">Delete Result </a></td>
  </tr>
</table>
<table width="177" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="173"><a href="logout.php" target="_parent">Logout</a></td>
  </tr>
</table>
</body>
</html>

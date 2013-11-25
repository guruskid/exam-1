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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<a href="admin.htm" target="_parent">Admin Page</a><br>
<table width="177" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="173"><a href="chpass1.php" target="main">Change Password</a></td>
  </tr>
</table>
<a href="advedit.php" target="_blank">Advanced Editor </a><br>
<table border="0" width="177">
  <tr>
    <td colspan="2">Question Management</td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="141"><a href="addques.php" target="main">Add Question</a><br> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="addques1.php" target="main">Alternate Add</a> </td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="141"><a href="showques.php" target="main">Show Questions</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="141"><a href="quesed.php" target="main">Edit Question</a><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="quesed1.php" target="main">Alternate Edit </a></td>
  </tr>
</table>
<br>
<table border="0" width="216">
  <tr>
    <td colspan="2">Question Paper</td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="180"><a href="creques.php" target="main">Create Question Paper</a></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="180"><a href="showpaper.php" target="main">Show Question Papers</a></td>
  </tr>
</table>
<br>
<table width="177" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="173"><a href="start.php" target="main">Start Exam </a></td>
  </tr>
  <tr>
    <td><a href="stop.php" target="main">Stop Exam </a></td>
  </tr>
</table>
<br>
<table width="177" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="2"><p>Result Page </p>    </td>
  </tr>
  <tr>
    <td width="29">&nbsp;</td>
    <td width="141"><a href="result1.php" target="main">By Question Paper </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="result2.php" target="main">By Student ID </a></td>
  </tr>
</table>
<a href="upload.php" target="main">File Upload </a><br>
<table width="177" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="173"><a href="logout.php" target="_parent">Logout</a></td>
  </tr>
</table>

</body>
</html>

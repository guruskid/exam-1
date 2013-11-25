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
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<script language="JavaScript">
function doSubmit() {
	if (document.creq.qcode.value=="" || document.creq.time.value=="" ||
		document.creq.noq.value=="" || document.creq.neg.value=="" ||
		  document.creq.table.value=="" ) {
			alert("Enter Valid Data");
			return false;
	}
	return true;
}
</script>
<form action="insques.php" method="post" name="creq">
<table border="0" width="299">
  <tr>
    <td width="144">Question Code</td>
    <td width="145"><input type="text" name="qcode" size="20"></td>
  </tr>
  <tr>
    <td width="144">Time (in minutes)</td>
    <td width="145"><input type="text" name="time" size="20"></td>
  </tr>
  <tr>
    <td width="144">Number of Questions</td>
    <td width="145"><input type="text" name="noq" size="20"></td>
  </tr>
  <tr>
    <td width="144">Negative marking</td>
    <td width="145"><input type="text" name="neg" size="20" value="0"></td>
  </tr>
  <tr>
    <td>From Qbank </td>
    <td>
	<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select tname,tinfo from info where ttype='subject'", $conn);
	print "<select size=\"1\" name=\"table\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]." -> ".$name_row[1]."</option>";
    }
	print "</select>";
	mysql_close($conn);
	?>
	</td>
  </tr>
</table>
 <br>
&nbsp;&nbsp;&nbsp; <input type="radio" value="manual" name="mode">Manual 
Selection of Question<br>
&nbsp;&nbsp;&nbsp; <input type="radio" name="mode" checked value="auto">Automatic Selection 
of Question<br>
<br>
Instructions: <br>
<textarea rows="5" name="inst" cols="60"></textarea><br>
<input type="submit" value="Go" onClick="return doSubmit()">
</form>
</body>
</html>

<?php
session_start();
header("Cache-control: private");
if (isset($_POST['sname']) && isset($_POST['suid']) ) {
$_SESSION['sta']='OK';
}
else {
	print "<font color=\"#FF0000\">Not Allowed";
	print "</font>";
	session_destroy();
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Choose your Question Paper</title>
<script language="javascript">
function doSubmit() {
	if (document.my.paper.value=="") {
		alert("Select Question Paper");
		return false;
		}
	return true;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<p><strong>Name:  </strong><?php echo $_POST['sname']; ?>
    </p>
<p><strong>Student ID:  </strong><?php echo $_POST['suid']; ?>
</p>
<form action="show.php" method="post" name="my">
<input type="hidden" name="sname" value="<?php echo $_POST['sname']; ?>">
<input type="hidden" name="suid" value="<?php echo $_POST['suid']; ?>">
<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select * from running", $conn);
	print "<strong>Choose Question Paper:  </strong>";
	print "<select size=\"1\" name=\"paper\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]."</option>";
    }
	print "</select>";
	mysql_close();
?>
<input type="submit" value="Go" onClick="return doSubmit()">
</form>
</body>
</html>

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
<?php

	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select tname,tinfo from info where ttype='subject'", $conn);
print<<<EndCode
<script language="JavaScript">
function doSubmit() {
if (document.my.table.value=="") {
	alert("Enter Subject Name");
	return false;
	}
return true;
}
</script>
EndCode;
	print "<form action=\"showques.php\" method=\"post\" name=\"my\">";
	print "<select size=\"1\" name=\"table\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]." -> ".$name_row[1]."</option>";
    }
	print "</select>";
	print "<input type=\"submit\" value=\"Show\" onClick=\"return doSubmit()\">";
	print "</form>";
	mysql_close($conn);
	if (isset($_POST['table'])) {
	print "Content of ".$_POST['table']."<br>";
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select * from ".$_POST['table'], $conn);
	print "Number of Questions are: ".mysql_num_rows($result)."<br>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<br><table BORDER=\"1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" cellpadding=\"0\" cellspacing=\"0\">";
	  print "<tr><td width=\"500\" colspan=\"2\"> <b>Question ID: ".$name_row[0]."</b></td></tr>";
	  print "<tr><td width=\"500\" colspan=\"2\">".$name_row[1]."</td></tr>";
	  print "<tr><td width=\"70\"><I>Option A</I></td><td width=\"400\">".$name_row[2]."</td></tr>";
	  print "<tr><td width=\"70\"><I>Option B</I></td><td width=\"400\">".$name_row[3]."</td></tr>";
	  print "<tr><td width=\"70\"><I>Option C</I></td><td width=\"400\">".$name_row[4]."</td></tr>";
	  print "<tr><td width=\"70\"><I>Option D</I></td><td width=\"400\">".$name_row[5]."</td></tr>";
	  print "<tr><td width=\"70\"><I>Option E</I></td><td width=\"400\">".$name_row[6]."</td></tr>";
	  print "<tr><td width=\"70\"><I>Correct</I></td><td width=\"400\">".$name_row[7]."</td></tr>";
	  print "<tr><td width=\"70\"><I>By:</I></td><td width=\"400\">".$name_row[8]."</td></tr>";
	  print "<tr><td width=\"500\" colspan=\"2\"><b>Explanation:</b><br>".$name_row[9]."</td></tr>";
      print "</table><br>";
	}
	mysql_close($conn);
}
?>
</body>
</html>

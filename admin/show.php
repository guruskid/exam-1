<?php
session_start();
header("Cache-control: private");
if (!isset($_SESSION['sta']) || $_SESSION['sta']!='OK' ) {
	print "<font color=\"#FF0000\">Not Allowed";
	print "</font>";
	session_destroy();
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Good Luck</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript">
function save() {
	document.exam.action="save.php";
	document.exam.submit();
}
function doSubmit() {
	document.exam.action="eval.php";
	if (confirm("Are you sure")) {
		return true;
	}
	return false;
}
function timeover() {
	document.exam.action="eval.php";
	alert("Timeover! Click ok to Continue.");
	document.exam.submit();
}
</script>
</head>

<body>
<?php
if (isset($_POST['sname'],$_POST['suid'],$_POST['paper'])) {
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select * from pques where qcode='".$_POST['paper']."'", $conn);
	$name_row = mysql_fetch_row($result);
	$sub=$name_row[1];
	$neg=$name_row[2];
	$time=$name_row[3];
	$qno=$name_row[4];
	$inst=$name_row[5];
	print "<table border=\"0\" bgcolor=\"#008000\" align=\"center\">";
	print "<tr>";
	print "<td width=\"200\">Name: ".$_POST['sname']."<br>Student ID: ".$_POST['suid']."<br>Paper Code: ".$_POST['paper']."</td>";
	print "<td width=\"500\">Time: ".$time." minutes.<br>Negative Mark: ".$neg." per wrong answer.<br>No of Questions: ".$qno;
	print "<br>Instructoins:<br>".$inst."</td></tr>";
	print "</table><br>";
	print "<form action=\"eval.php\" method=\"post\" name=\"exam\" target=\"footer\">";
	// code for redirecting and save
	print "<input type=\"hidden\" name=\"qcode\" value=\"".$_POST['paper']."\">";
	print "<input type=\"hidden\" name=\"sname\" value=\"".$_POST['sname']."\">";
	print "<input type=\"hidden\" name=\"suid\" value=\"".$_POST['suid']."\">";
	print "<input type=\"hidden\" name=\"sub\" value=\"".$sub."\">";
	print "<input type=\"hidden\" name=\"neg\" value=\"".$neg."\">";
	$result = mysql_query("select ".$sub.".ques,".$sub.".opa,".$sub.".opb,".$sub.".opc,".$sub.".opd,".$sub.".ope,".$sub.".qid from ".$sub.",".$_POST['paper']." where ".$sub.".qid=".$_POST['paper'].".qid order by rand()", $conn);
	if (mysql_errno()) {
		print mysql_error();
		exit;
	}
	$quesno=0;
	while ($name_row = mysql_fetch_row($result)) {
		print "<br><table BORDER=\"0\" bgcolor=\"#FFFFFF\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
		print "<tr><td width=\"100%\" colspan=\"2\">[Q".($quesno+1)."] ".$name_row[0]."<input type=\"hidden\" name=\"quesid[]\" value=\"".$name_row[6]."\"></td></tr>";
		print "<tr><td width=\"10%\"><I><input type=\"checkbox\" name=\"ans[".$quesno."][]\" value=\"A\"> A</I></td><td width=\"90%\">".$name_row[1]."</td></tr>";
		print "<tr><td width=\"10%\"><I><input type=\"checkbox\" name=\"ans[".$quesno."][]\" value=\"B\"> B</I></td><td width=\"90%\">".$name_row[2]."</td></tr>";
		print "<tr><td width=\"10%\"><I><input type=\"checkbox\" name=\"ans[".$quesno."][]\" value=\"C\"> C</I></td><td width=\"90%\">".$name_row[3]."</td></tr>";
		print "<tr><td width=\"10%\"><I><input type=\"checkbox\" name=\"ans[".$quesno."][]\" value=\"D\"> D</I></td><td width=\"90%\">".$name_row[4]."</td></tr>";
		print "<tr><td width=\"10%\"><I><input type=\"checkbox\" name=\"ans[".$quesno."][]\" value=\"E\"> E</I></td><td width=\"90%\">".$name_row[5]."</td></tr>";
		print "<tr><td width=\"100%\" colspan=\"2\"><input type=\"submit\" value=\"Save\" onClick=\"save()\"></td></tr>";
		print "</table><br>";
		$quesno++;
	}
	print "<input type=\"submit\" value=\"Submit\" onClick=\"return doSubmit()\">";
	print "</form>";
}
print "<SCRIPT LANGUAGE=\"JavaScript\">";
print "setTimeout(\"timeover()\",".$time."*60*1000);";
print "</SCRIPT>";
?>
</body>
</html>

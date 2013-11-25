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
<form method="post">
<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select tname from info where ttype='ques'", $conn);
	print "Number of Question Papers are: ".mysql_num_rows($result);
	print "<br><select size=\"1\" name=\"ques\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	 	 print "<option value=".$name_row[0].">".$name_row[0]."</option>";
	}
	print "</select></br>";
	mysql_close($conn);
?>
    <br>
    <input type="radio" value="stu" name="mode"> Student View <br>
    <input type="radio" name="mode" checked value="tea"> Teacher View <br>
    <br>
    <input type="submit" value="View">
</form>
<hr width="50%">
<?php
if (isset($_POST['ques'],$_POST['mode']) && $_POST['ques']!="") {
	if ($_POST['mode']=="stu") {
		print "Student View of ".$_POST['ques']."<br>";
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("select * from pques where qcode='".$_POST['ques']."'", $conn);		
		if (mysql_num_rows($result))
			{
				$name_row = mysql_fetch_row($result);
				$sub=$name_row[1];
			}
		else {
			print "<font color=\"#FF0000\">Error...</font>";
			exit;
		}
		print "Negative mark: ".$name_row[2]." per wrong answer.<br>";
		print "Time: ".$name_row[3]." minutes.<br>";
		print "<B>Instructions: </B><br><I>".$name_row[5]."</I><br>";
		$result = mysql_query("select ".$sub.".ques,".$sub.".opa,".$sub.".opb,".$sub.".opc,".$sub.".opd,".$sub.".ope from ".$sub.",".$_POST['ques']." where ".$sub.".qid=".$_POST['ques'].".qid", $conn);
		if (mysql_errno()) {
			print mysql_error();
		}
		print "Number of Questions are: ".mysql_num_rows($result)."<br>";
		while ($name_row = mysql_fetch_row($result)) {
	  		print "<br><table BORDER=\"1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" cellpadding=\"0\" cellspacing=\"0\">";
	  		print "<tr><td width=\"500\" colspan=\"2\">".$name_row[0]."</td></tr>";
	  		print "<tr><td width=\"70\"><I>Option A</I></td><td width=\"400\">".$name_row[1]."</td></tr>";
	  		print "<tr><td width=\"70\"><I>Option B</I></td><td width=\"400\">".$name_row[2]."</td></tr>";
	  		print "<tr><td width=\"70\"><I>Option C</I></td><td width=\"400\">".$name_row[3]."</td></tr>";
	  		print "<tr><td width=\"70\"><I>Option D</I></td><td width=\"400\">".$name_row[4]."</td></tr>";
	  		print "<tr><td width=\"70\"><I>Option E</I></td><td width=\"400\">".$name_row[5]."</td></tr>";
	  		print "</table><br>";
		}
	}
	else if ($_POST['mode']=="tea") {
		print "Teacher View of ".$_POST['ques']."<br>";
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("select sub from pques where qcode='".$_POST['ques']."'", $conn);
		if (mysql_num_rows($result))
			{
				$name_row = mysql_fetch_row($result);
				$sub=$name_row[0];
			}
		else {
			print "<font color=\"#FF0000\">Error...</font>";
			exit;
		}
		$result = mysql_query("select ".$sub.".qid,".$sub.".ques,".$sub.".opa,".$sub.".opb,".$sub.".opc,".$sub.".opd,".$sub.".ope,".$sub.".corr,".$sub.".susr,".$sub.".expl from ".$sub.",".$_POST['ques']." where ".$sub.".qid=".$_POST['ques'].".qid", $conn);
		if (mysql_errno()) {
			print mysql_error();
		}
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
	}
}
	else {
		print "<font color=\"#FF0000\">Fill the data form</font>";
	}
?>
</body>
</html>

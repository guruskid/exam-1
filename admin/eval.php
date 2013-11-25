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
<title>Submit</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php 
if (isset($_POST['quesid'],$_POST['qcode'],$_POST['sname'],$_POST['suid'],$_POST['sub'],$_POST['neg'])) {
	$no=count($_POST['quesid']);
	$corrans=0;
	$wrong=0;
	$conn = mysql_connect("localhost", "universal", "acumen")
       	or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
    	or die("Could not select database.");
	$result = mysql_query("select * from running where qcode='".$_POST['qcode']."'", $conn);
	if (mysql_errno())
		print "<font color=\"#FF0000\">Error...</font>".mysql_error();
	if (!mysql_num_rows($result)) {
		print "<font color=\"#FF0000\">Examination is stopped!!!</font></body></html>";
		session_destroy();
		exit;
	}
	for ($i=0;$i<$no;$i++) {
		$ans="";
		for ($j=0;$j<5;$j++) {
			if (isset($_POST['ans'][$i][$j])) {
				$ans=$ans.$_POST['ans'][$i][$j];
			}
		}
		if ($ans != "") {
			$result = mysql_query("select corr from ".$_POST['sub']." where qid='".$_POST['quesid'][$i]."'", $conn);		
			$name_row = mysql_fetch_row($result);
			if ($name_row[0]==$ans) {
				$corrans++;
				}
			else {
				$wrong++;
				}
		}
	}
	$marks=$corrans-$_POST['neg']*$wrong;
	$result = mysql_query("select sta from result where qcode='".$_POST['qcode']."' and sid='".$_POST['suid']."'", $conn);
	if (mysql_num_rows($result)) {
	// if already saved before;
	$name_row = mysql_fetch_row($result);
		if ($name_row[0]==0) {
		// write code for update table
			mysql_query("update result set qcode='".$_POST['qcode']."',sid='".$_POST['suid']."',sname='".$_POST['sname']."',marks=".$marks.",time=now(),sta=1 where qcode='".$_POST['qcode']."' and sid='".$_POST['suid']."'",$conn);
			if (mysql_errno()) {
				print "<font color=\"#FF0000\">Error...</font>".mysql_error();
			}
			else {
				print "Thank You.";
			}
		}
		else {
			print "<font color=\"#FF0000\">Your record is already present.</font>";
		}
	}
	else {
		mysql_query("insert into result values ('".$_POST['qcode']."','".$_POST['suid']."','".$_POST['sname']."',".$marks.",now(),1)",$conn);
		if (mysql_errno()) {
			print "<font color=\"#FF0000\">Error...</font>".mysql_error();
		}
		else {
			print "Thank you";
		}
	}
	mysql_close();
}
session_destroy();
?>
</body>
</html>

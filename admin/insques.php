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
	if (isset($_POST['qcode'],$_POST['time'],$_POST['noq'],$_POST['neg'],$_POST['mode'],$_POST['inst'])) {
		if ($_POST['mode']=='auto' && $_POST['noq']>=1) {
			$inst=str_replace1($_POST['inst']);
			$conn = mysql_connect("localhost", "universal", "acumen")
          		or die("Could not connect to MySQL.<br>");
			$selected = mysql_select_db("exam", $conn)
          		or die("Could not select database.");
			$result = mysql_query("select * from ".$_POST['table'], $conn);
			$no=mysql_num_rows($result);
			if ($no>=$_POST['noq']) {
				mysql_query("create table ".$_POST['qcode']." (qid int(4) NOT NULL, primary key(qid))",$conn);
				$sta1=mysql_errno();
				mysql_query("insert into info values ('".$_POST['qcode']."','From ".$_POST['table']."','ques')",$conn);
				$sta2=mysql_errno();
				mysql_query("insert into ".$_POST['qcode']." select distinct qid from ".$_POST['table']." order by rand() limit ".$_POST['noq'],$conn);
				$sta3=mysql_errno();
				mysql_query("insert into pques values('".$_POST['qcode']."','".$_POST['table']."',".$_POST['neg'].",".$_POST['time'].",".$_POST['noq'].",'".$inst."')",$conn);
				$sta4=mysql_errno();
				if ($sta1 || $sta2 || $sta3 || $sta4) {
					print "<font color=\"#FF0000\">Error...<br>";
					print "</font>";
				}
				else {
					print "Question Paper Created having code ".$_POST['qcode'];
				}
			}
			else {
				print "Number of questions exceed the size";
			}
		}
		else if ($_POST['mode']=='manual' && $_POST['noq']>=1) {
			//echo $_POST['mode'];
			print "<form action=\"manual.php\" method=\"post\">";
			print "<input type=\"hidden\" name=\"qcode\" value=\"".$_POST['qcode']."\">";
			print "<input type=\"hidden\" name=\"time\" value=\"".$_POST['time']."\">";
			print "<input type=\"hidden\" name=\"tbl\" value=\"".$_POST['table']."\">";
			print "<input type=\"hidden\" name=\"noq\" value=\"".$_POST['noq']."\">";
			print "<input type=\"hidden\" name=\"neg\" value=\"".$_POST['neg']."\">";
			print "<input type=\"hidden\" name=\"inst\" value=\"".$_POST['inst']."\">";
			$conn = mysql_connect("localhost", "universal", "acumen")
          		or die("Could not connect to MySQL.<br>");
			$selected = mysql_select_db("exam", $conn)
          		or die("Could not select database.");
			$result = mysql_query("select * from ".$_POST['table'], $conn);
			print "Number of Questions are: ".mysql_num_rows($result)."<br>";
			print "Please select ".$_POST['noq']." questions.";
			while ($name_row = mysql_fetch_row($result)) {
	  			print "<br><table BORDER=\"1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" cellpadding=\"0\" cellspacing=\"0\">";
	  			print "<tr><td width=\"500\" colspan=\"2\"> <b>Question ID: ".$name_row[0]."<input type=\"checkbox\" name=\"quesid[]\" value=\"".$name_row[0]."\"></b></td></tr>";
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
			print "<br><input type=\"submit\" value=\"Create\">";
			print "</form>";
		}
		else {
			print "<font color=\"#FF0000\">Invalid Entry</font>";
		}
	}
?>
</body>
</html>

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
if (isset($_POST['qcode'],$_POST['time'],$_POST['tbl'],$_POST['noq'],$_POST['neg'],$_POST['inst'],$_POST['quesid'])) {
	/*echo $_POST['qcode']."<br>";
	echo $_POST['time']."<br>";
	echo $_POST['tbl']."<br>";
	echo $_POST['noq']."<br>";
	echo $_POST['neg']."<br>";
	echo $_POST['inst']."<br>";
	echo count($_POST['quesid'])."<br>";*/
	$no=count($_POST['quesid']);
	if ($no!=$_POST['noq']) {
		print "<font color=\"#FF0000\">Please select ".$_POST['noq']." questions.<br>";
		print "Currently Selected ".$no." questions<br></font>"; 
		}
	else {
			$inst=str_replace1($_POST['inst']);
			$not_ok=0;
			$conn = mysql_connect("localhost", "universal", "acumen")
          		or die("Could not connect to MySQL.<br>");
			$selected = mysql_select_db("exam", $conn)
          		or die("Could not select database.");
			mysql_query("create table ".$_POST['qcode']." (qid int(4) NOT NULL, primary key(qid))",$conn);
			$sta1=mysql_errno();
			mysql_query("insert into info values ('".$_POST['qcode']."','From ".$_POST['tbl']."','ques')",$conn);
			$sta2=mysql_errno();
			mysql_query("insert into pques values('".$_POST['qcode']."','".$_POST['tbl']."',".$_POST['neg'].",".$_POST['time'].",".$_POST['noq'].",'".$inst."')",$conn);
			$sta3=mysql_errno();
			for ($i=0;$i<$no;$i++) {
				mysql_query("insert into ".$_POST['qcode']." values(".$_POST['quesid'][$i].")",$conn);
				if (mysql_errno()) {
					$not_ok=1;
					break;
				}
			}
			if ($sta1 || $sta2 || $sta3 || $not_ok)
			{
				print "<font color=\"#FF0000\">Error...</font>";
			}
			else {
				print "Question Paper Created having code ".$_POST['qcode'];
			}
		}
	}
?> 
</body>
</html>

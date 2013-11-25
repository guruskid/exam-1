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
// used for alternate edit.
if (isset($_POST['tbl']) && isset($_POST['hidden0']) && isset($_POST['opA']) && isset($_POST['opB']) && isset($_POST['opC']) && isset($_POST['opD']) && isset($_POST['opE']) && isset($_POST['correct']) && isset($_POST['author'])) {
	$question=str_replace1($_POST['hidden0']);
	$optionA=str_replace1($_POST['opA']);
	$optionB=str_replace1($_POST['opB']);
	$optionC=str_replace1($_POST['opC']);
	$optionD=str_replace1($_POST['opD']);
	$optionE=str_replace1($_POST['opE']);
	$correct=str_replace1($_POST['correct']);
	$author=str_replace1($_POST['author']);
	if (isset($_POST['expl'])) {
		$expl=str_replace1($_POST['expl']);
		}
	else {
		$expl="";
	}
	
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	mysql_query("update ".$_POST['tbl']." set ques='".$question."',opa='".$optionA."',opb='".$optionB."',opc='".$optionC."',opd='".$optionD."',ope='".$optionE."',corr='".$correct."',susr='".$author."',expl='".$expl."' where qid=".$_POST['qid']);
	if (!mysql_errno()) {
		print "Question Successfully Edited and Added to<br>".$_POST['tbl'];
	}
	else {
		print "<font color=\"#FF0000\">Error ... ".$_POST['tbl']."<br>".mysql_error();
		print "</font>";
	}
	mysql_close($conn);
}
else {
echo "<font color=\"#FF0000\">Unexpected Error Occured.</font>";
}
?>
</body>
</html>

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
<script language="javascript">
function doSubmit() {
if (document.my.tbl.value=="" || document.my.qid.value=="") {
	alert("Enter valid data.");
	return false;
	}
	return true;
}
</script>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="quesed.php" method="post" name="my">
<?php
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	$result = mysql_query("select tname,tinfo from info where ttype='subject'", $conn);
	print "<select size=\"1\" name=\"tbl\">";
	print "<option></option>";
	while ($name_row = mysql_fetch_row($result)) {
	  print "<option value=".$name_row[0].">".$name_row[0]." -> ".$name_row[1]."</option>";
    }
	print "</select>";
	mysql_close($conn);
?>
<BR>Question ID: <input type="text" name="qid">
<input type="submit" value="Edit" onClick="return doSubmit()">
</form>
<?php
		if (isset($_POST['tbl'],$_POST['qid'])) {
		$tbl=$_POST['tbl'];
		$qid=$_POST['qid'];
		$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
		$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
		$result = mysql_query("select ques,opa,opb,opc,opd,ope,corr,susr,expl from ".$_POST['tbl']." where qid='".$_POST['qid']."'");
		$id=mysql_num_rows($result);
		if ($id==1) {
			$name_row = mysql_fetch_row($result);
		}
		else {
			print "<font color=\"#FF0000\">Error...</font>";
		}
		mysql_close($conn);
		}
		if (isset($name_row[0],$name_row[1],$name_row[2],$name_row[3],$name_row[4],$name_row[5],$name_row[6],$name_row[7],$name_row[8]))
		{
		for($iii=0;$iii<count($name_row);$iii++)
			$name_row[$iii]=htmlspecialchars($name_row[$iii],ENT_QUOTES);
		$name_ques=htmlspecialchars($name_row[0],ENT_QUOTES);
print <<<EndCode
<form action="addqu1.php" method="post" name="hid">
<input type="hidden" name="c0" value="$name_ques">
<input type="hidden" name="c1" value="$name_row[1]">
<input type="hidden" name="c2" value="$name_row[2]">
<input type="hidden" name="c3" value="$name_row[3]">
<input type="hidden" name="c4" value="$name_row[4]">
<input type="hidden" name="c5" value="$name_row[5]">
<input type="hidden" name="c6" value="$name_row[6]">
<input type="hidden" name="c7" value="$name_row[7]">
<input type="hidden" name="c8" value="$name_row[8]">
<input type="hidden" name="tble" value="$tbl">
<input type="hidden" name="qid" value="$qid">
</form>
<script>
   document.hid.submit();
</script>
EndCode;
}
?>
</body>
</html>

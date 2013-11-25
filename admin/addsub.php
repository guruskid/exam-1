<?php
session_start();
header("Cache-control: private"); 
@include("function.php");
if (!check()) { 
 	header("Location: admin.htm");
	session_destroy();
	exit;
}
else {
	if(isset($_SESSION['uname']) && $_SESSION['uname']!="root") {
		header("Location: admin.htm");
		session_destroy();
		exit;
	}
}
$ppp=<<<EndCode
<form method="POST" action="addsub.php" name="sub">
<script language="JavaScript">
function doSubmit() {
if (document.sub.sname.value=="" || document.sub.sdes.value=="") {
	alert("Enter Valid Data");
	return false;
	}
else {
	document.sub.submit();
	}
}
</script>
  <table border="1" width="366">
    <tr>
      <td width="163">Name Question Book:&nbsp; </td>
      <td width="187"><input type="text" name="sname" size="27" maxlength="10"></td>
    </tr>
    <tr>
      <td width="163">Description:</td>
      <td width="187"><input type="text" name="sdes" size="27" maxlength="25"></td>
    </tr>
  </table>
  <input type="submit" value="Add Subject" onClick="return doSubmit()">
  <input type="hidden" name="val" value="1">
</form>
EndCode;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
// It's a script that is allowed to the administrator only.
// He can create the subject means (Question Bank)
if (isset($_POST['val']) && $_POST['val']==1) {
	$conn = mysql_connect("localhost", "universal", "acumen")
          or die("Could not connect to MySQL.<br>");
	$selected = mysql_select_db("exam", $conn)
          or die("Could not select database.");
	mysql_query("create table ".$_POST['sname']." (qid int(4) NOT NULL AUTO_INCREMENT,ques text NOT NULL,opa text NOT NULL,opb text NOT NULL,opc text NOT NULL,opd text NOT NULL,ope text NOT NULL,corr varchar(8) NOT NULL, susr varchar(50) NOT NULL, expl text,primary key(qid))",$conn);
	if (!mysql_errno()) {
		mysql_query("insert into info values ('".$_POST['sname']."','".$_POST['sdes']."','subject')");
		print "<html><head><link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"></head>";
		print "Subject Successfully Created <br>".$_POST['sname'];
		print "<br><a href=\"showtbl.php\">Show Subjects</a></html>";
	}
	else {
		print "<html><font color=\"#FF0000\">Error Adding Subject: ".$_POST['sname']."<br>".mysql_error();
		print "<br></font></html>";
	}
	mysql_close($conn);
	}
else {
	print $ppp;
}
?>
</body>
</html>

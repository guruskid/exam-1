<?php
session_start();
header("Cache-control: private");
if (isset($_POST['uname']) && isset($_POST['passwd']) ) {
$_SESSION['uname']=$_POST['uname'];
$_SESSION['passwd']=$_POST['passwd'];
$_SESSION['stat']="";
}
@include("function.php");
if (!check() || $_POST['uname']!='root') { 
 	header("Location: admin.htm");
	session_destroy();
	exit;
}
else {
	print "<html><title>Welcome ".$_SESSION['fname']."</title>";
	
// The frames begin from here.	
print <<<EndCode
<frameset cols="250,*" border="0">
  <frame name="contents" target="main" src="lefta.php" scrolling="auto" noresize>
  <frame name="main" src="righta.php">
</frameset>
EndCode;
	
	print "</html>";
}
?>
<?php
session_start();
header("Cache-control: private");
if (isset($_POST['uname']) && isset($_POST['passwd']) ) {
$_SESSION['uname']=$_POST['uname'];
$_SESSION['passwd']=$_POST['passwd'];
}
@include("function.php");
if (!check()) { 
 	header("Location: index.htm");
	session_destroy();
	exit;
}
else {
	print "<html><title>Welcome ".$_SESSION['fname']."</title>";
	
// The frames begin from here. Page for users. left frame is content page
// The output will be shown in the main frame
print <<<EndCode
<frameset cols="200,*" border="0">
  <frame name="contents" target="main" src="left.php" scrolling="auto" noresize>
  <frame name="main" src="right.php">
</frameset>
EndCode;
	
	print "</html>";
}
?>
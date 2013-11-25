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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1><font color="#000080"><b>Welcome <?php echo $_SESSION['fname']; ?></b></font></h1>
</body>
</html>

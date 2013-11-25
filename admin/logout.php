<?php
session_start();
@include("function.php");
if (!check()) { 
 	header("Location: index.htm");
	session_destroy();
	exit;
}
if (isset($_SESSION['fname'])) {
	 header("Location: index.htm");
}
session_destroy();
?>

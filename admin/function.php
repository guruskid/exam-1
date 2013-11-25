<?php
// this is my library of functions
// to include this library use ~11..@include("../function.php");..11~

// User authentication is done by the following function
// To avoid every time connecting to the database I have created 
// A session variable storing the correctness value once it is 
// Checked the user name and password and found correct there by
// decreasing the executing time
function check() {
  /*session_start();
  header("Cache-control: private");*/
  if (isset($_SESSION['uname']) && isset($_SESSION['passwd']) ) 
  {
	if (isset($_SESSION['stat']) && $_SESSION['stat']=='ok') {
		return true;
	}
	$conn = mysql_connect("localhost", "universal", "acumen");
	if (mysql_errno()) {
		return false;
	}
	$selected = mysql_select_db("exam", $conn);
	if (mysql_errno()) {
		return false;
	}
	$result=mysql_query("select * from user where uname='".$_SESSION['uname']."' and password=password('".$_SESSION['passwd']."')");
	if (mysql_num_rows($result)) {
		$name_row = mysql_fetch_row($result);
		$_SESSION['fname']=$name_row[1];
		$_SESSION['stat']='ok';
		return true;
	}
	return false;
  }
  else { return false; }
}
// let a variable contain what's your name?
// when the following function is applied it will return
// what\'s your name?.. 
function str_replace1($text) {
// for linux OS is not required as the variables contain the data in the 
// format the purpose of the following function
	$len=strlen($text);
	$new="";
	for ($i=0;$i<$len;$i++) {
		if ($text{$i}=='\\') {
			$new=$new.'\\\\';
		}
		else if ($text{$i}=='\'') {
			$new=$new.'\\\'';
		}
		else
			$new=$new.$text{$i};
	}
	return $new;
}

?>
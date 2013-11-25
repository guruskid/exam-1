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
<title>File Upload</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="javascript">
function doSubmit() {
	if (document.form1.file.value=="") {
		alert("Please select a file");
		return false;
	}
	return true;
}
</script>
<body>
<form name="form1" enctype="multipart/form-data" method="post">
  <input type="file" name="file">
  <input type="submit" value="Upload" onClick="return doSubmit()">
</form>
<?php 
if (isset($HTTP_POST_FILES['file'])) {
	if (copy($HTTP_POST_FILES['file']['tmp_name'],"../photos/".$HTTP_POST_FILES['file']['name'])) {
		print "Successfuly Uploaded ".$HTTP_POST_FILES['file']['name'];
	}
	else {
		print "<font color=\"#FF0000\">Error...</font>";
	}
}
?>
</body>
</html>

<?php
// Only the administrator is allowed to execute this script!!!
// Here I am going to create the databases and the tables
// A universal user will also be created.
$ppp=<<<EndCode
<html>
<head>
<title>Administrator</title>
<script language="JavaScript">
function start() {
	login.uname.focus();
}
function doSubmit()
{
	// form validation Script
	if (login.uname.value=="" || login.passwd.value=="") {
		alert("Please enter valid data.");
		return false;
    }
	document.login.submit();
}
</script>
</head>
<body onLoad="start()">
<form action="make.php" method="post" name="login">
<center>
<table cellspacing="0" cellpadding="5" border="0" width="245" align="right">
 <tr>
 	<td colspan="2" bgcolor="#99CCFF"><B><font color="#800000">Login Administrator</font></B></td>
 </tr>
 <tr>
   <td bgcolor="#C0C0C0" width="64"><font color="#800000">Username:</font></td>
   <td bgcolor="#C0C0C0" width="181"><input type="text" name="uname" size="22"></td>
 </tr>
 <tr>
   <td bgcolor="#C0C0C0" width="64"><font color="#800000">Password:</font></td>
   <td bgcolor="#C0C0C0" width="181">
   <input type="password" name="passwd" size="15"  maxlength="10">&nbsp;&nbsp;
   <input type="submit" value="Go" onClick="return doSubmit()"></td>
 </tr>
</table>
</center>
</form>
</body>
EndCode;
?>
<?php
if (isset($_POST['uname']) && isset($_POST['passwd'])) {
   	if ($_POST['uname']=="root") {
	// if administrator, then create databases and users
	// .
		$conn = mysql_connect("localhost", $_POST['uname'], $_POST['passwd'])
          or die("Could not connect to MySQL.<br>");
		print "<h1><I>Login Successful</I></h1>";
    	if ( !mysql_query("create database exam", $conn)) {
      		echo "Error...<br>".mysql_error();
	  		// print existing database configurations & create new user
			// because database is already present
			mysql_query("GRANT ALL PRIVILEGES on exam.* TO universal@localhost IDENTIFIED BY 'acumen';");
	  		$selected = mysql_select_db("exam", $conn)
            	or die("Could not select database.");
	  		$result = mysql_query("show tables", $conn);
      		print "<br><br><hr><table BORDER=1>";
	  		print "<tr><td>Tables</td></tr>";
	  		while ($name_row = mysql_fetch_row($result)) {
	    		echo "<TR>";
        		echo "<TD>",$name_row[0],"</TD>";
        		echo "</TR>";
      		}
      	print "</table><hr>";
		print "User name: universal<br>";
	  	echo "<br><I>Closing...</I>";
	  	mysql_close($conn);
	  	exit;
    	}
		else {
			$selected = mysql_select_db("exam", $conn)
            	or die("Could not select database.");
			// Once the database is selected...create the tables.
			// 'Info' table will describe all the tables in database exam
			// Table 'user' for users and their passwords
			// Table 'pques' is properties of question papers
			// Table 'result' for storing results of students
			// Table 'running' will show how many exams are currently running
			mysql_query("create table info (tname varchar(30) NOT NULL,tinfo varchar(50) NOT NULL,ttype varchar(30) NOT NULL,primary key(tname))",$conn);
			mysql_query("create table user (uname varchar(30) NOT NULL,fname varchar(50) NOT NULL,password varchar(20) NOT NULL, primary key(uname))",$conn);
			mysql_query("insert into user values ('root','admin',password('".$_POST['passwd']."'))");
			mysql_query("insert into info values ('info','System information','admin')");
			mysql_query("insert into info values ('user','User information','admin')");
			mysql_query("GRANT ALL PRIVILEGES on exam.* TO universal@localhost IDENTIFIED BY 'acumen';");
			mysql_query("insert into user values ('universal','Normal Usr',password('acumen'))");
			mysql_query("create table pques (qcode varchar(30) NOT NULL,sub varchar(30) NOT NULL,qneg float NOT NULL,qtime int(4) NOT NULL,qnos int(4) NOT NULL,qinst text, primary key(qcode))",$conn);
			mysql_query("insert into info values ('pques','Question Format & Properties','admin')");
			mysql_query("create table result (qcode varchar(30) NOT NULL,sid varchar(10) NOT NULL, sname varchar(50),marks float, time datetime, sta int(2) NOT NULL,primary key(qcode,sid))",$conn);
			mysql_query("insert into info values ('result','Results Table','admin')",$conn);
			mysql_query("create table running (qcode varchar(30) NOT NULL, primary key(qcode))",$conn);
			mysql_query("insert into info values ('running','Running Examinations','admin')");
			print "<html><title>Make Successful</title>";
    		print "<h1>Database and Tables Created. <br> Please don't run it again.</h1>";
		    $result = mysql_query("show tables", $conn);
		    print "<br><br><hr><table BORDER=1>";
			print "<tr><td>Tables</td></tr>";
			while ($name_row = mysql_fetch_row($result)) {
			  echo "<TR>";
		      echo "<TD>",$name_row[0],"</TD>";
		      echo "</TR>";
      		}
    		print "</table><hr>";
			print "User name: universal<br>";
			print "</html>";
			mysql_close($conn);
		}	
	}
	
	else {
		print "<font color=\"#FF0000\"><h1>Log in Unsucessful.</h1></font>";
		print $ppp;
	}
}
else {
print $ppp;
}
?>
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
<head>
<script language="JavaScript">
function doSubmit() {
   document.my.hidden0.value=document.my.ques.value;
    var ch="";
	for(var i=0;i<document.my.correc.length;i++)
	{
	if (document.my.correc[i].selected)
	  ch=ch+document.my.correc[i].value;
	}
	document.my.correct.value=ch;
   if (document.my.opE.value=="")
   		document.my.opE.value="None";
   if (document.my.tbl.value=="" || document.my.hidden0.value=="" ||
   		document.my.opA.value=="" || document.my.opB.value=="" ||
   			document.my.opC.value=="" || document.my.opD.value=="" ||
				document.my.correct.value=="" || document.my.author.value=="") {
					alert("Enter Valid Data");
					return false;
					}
   document.my.submit();
}
</script>
</head>
<body>
<FORM action="addq.php" method="post" name="my">
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
<br>Enter Question<br>
<textarea rows="10" name="ques" cols="60"></textarea><br>
Enter Option A<br>
<textarea rows="5" name="opA" cols="60"></textarea><br>
Enter Option B<br>
<textarea rows="5" name="opB" cols="60"></textarea><br>
Enter Option C<br>
<textarea rows="5" name="opC" cols="60"></textarea><br>
Enter Option D<br>
<textarea rows="5" name="opD" cols="60"></textarea><br>
Enter Option E<br>
<textarea rows="5" name="opE" cols="60"></textarea><br>
<input type="hidden" name="hidden0">
</p>
<table border="0" width="601">
  <tr>
    <td width="257">Correct Answer: 
	  <br>
      <select name="correc" size="5" multiple>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
      </select>
	  <input type="hidden" name="correct">
    </td>
    <td width="334">Submitted By: <input type="text" name="author" size="20" value="<?php echo $_SESSION['fname'];?>"></td>
  </tr>
</table>
Explanation: <br>
<textarea rows="5" name="expl" cols="60"></textarea><br>
<INPUT TYPE="button" VALUE="Submit" onClick="return doSubmit()"> </p>
</p>
</FORM>
</body>
</html>
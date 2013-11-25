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
<?php
/*echo $_POST['c0'];
echo "<br>";
echo $_POST['c1'];
echo "<br>";
echo $_POST['c2'];
echo "<br>";
echo $_POST['c3'];
echo "<br>";
echo $_POST['c4'];
echo "<br>";
echo $_POST['c5'];
echo "<br>";
echo $_POST['c6'];
echo "<br>";
echo $_POST['c7'];
echo "<br>";
echo $_POST['c8'];
echo "<br>";
echo $_POST['tble'];
echo "<br>";
echo $_POST['qid'];*/
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
<FORM action="addq1.php" method="post" name="my">
<br>Enter Question<br>
<textarea rows="10" name="ques" cols="60"><?php if (isset($_POST['c0'])) { echo $_POST['c0']; }?></textarea><br>
Enter Option A<br>
<textarea rows="5" name="opA" cols="60"><?php if (isset($_POST['c1'])) { echo $_POST['c1']; }?></textarea><br>
Enter Option B<br>
<textarea rows="5" name="opB" cols="60"><?php if (isset($_POST['c2'])) { echo $_POST['c2']; }?></textarea><br>
Enter Option C<br>
<textarea rows="5" name="opC" cols="60"><?php if (isset($_POST['c3'])) { echo $_POST['c3']; }?></textarea><br>
Enter Option D<br>
<textarea rows="5" name="opD" cols="60"><?php if (isset($_POST['c4'])) { echo $_POST['c4']; }?></textarea><br>
Enter Option E<br>
<textarea rows="5" name="opE" cols="60"><?php if (isset($_POST['c5'])) { echo $_POST['c5']; }?></textarea><br>
<input type="hidden" name="hidden0">
<input type="hidden" name="tbl" value="<?php if (isset($_POST['tble'])) { echo $_POST['tble']; }?>">
<input type="hidden" name="qid" value="<?php if (isset($_POST['qid'])) { echo $_POST['qid']; }?>">

</p>
<table border="0" width="601">
  <tr>
   <td width="112">The Previous Correct Answer:<br><h1><b>
      <?php if (isset($_POST['c6'])) {echo $_POST['c6'];}?>
      </b></h1>
      <input type="hidden" name="correct">    </td>
	<td width="140">Enter Correct Ans: <br>
      <select name="correc" size="5" multiple>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
      </select></td>
    <td width="334">Submitted By: <input type="text" name="author" size="20" value="<?php if (isset($_POST['c7'])) {echo $_POST['c7'];}?>"></td>
  </tr>
</table>
Explanation: <br>
<textarea rows="5" name="expl" cols="60"><?php if (isset($_POST['c8'])) { echo $_POST['c8']; }?></textarea><br>
<INPUT TYPE="button" VALUE="Submit" onClick="return doSubmit()"> </p>
</p>
</FORM>
</body>
</html>
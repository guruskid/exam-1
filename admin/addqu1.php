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
/*
This Script is for editing the questions. It prints the corresponding
Form elements and sets the value that was stored in the database.
*/


?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function Start() {
  document.getElementById('myEditor0').contentWindow.document.designMode = "on";
}
function restore() {
if (document.my.hidden1.value!="") {
	document.getElementById('myEditor0').contentWindow.document.body.innerHTML=document.my.hidden1.value;
	document.my.hidden1.value="";
	}
}
function selOn(ctrl) {
   ctrl.style.backgroundColor = '#B5BED6';
}
function selOff(ctrl) {
   ctrl.style.backgroundColor = '#D4D0C8';
}
function doAction(act) {
          var mainField;
          mainField = document.getElementById('myEditor0').contentWindow;
          mainField.focus();
          mainField.document.execCommand(act, false, null);
          mainField.focus();
}

function selDown(ctrl) {
   ctrl.style.backgroundColor = '#B5BED6';
}
function selUp(ctrl) {
   ctrl.style.backgroundColor = '#DACCFF';
}
function doSubmit() {
   document.my.hidden0.value=document.getElementById('myEditor0').contentWindow.document.body.innerHTML;
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
<body onload="Start()">
<FORM action="addq1.php" method="post" name="my">
<input type="button" value="Can't see question!!! Restore Question" onClick="restore()"><br><br>
Enter Question
<table border="0" cellpadding="0" cellspacing="0" width="299">
  <tr>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" alt="Bold" src="../images/bold.gif" width="25" height="24" 
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('bold')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" alt="Italic" src="../images/italic.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('Italic')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/underline.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('Underline')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/undo.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('undo')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/redo.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('redo')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/j_left.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('justifyleft')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/j_center.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('justifycenter')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/j_right.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('justifyright')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/indent.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('indent')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/outdent.gif" width="25" height="24"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('outdent')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="24" ><img border="0" src="../images/sup.gif" width="18" height="18"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('superscript')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="25" ><img border="0" src="../images/sub.gif" width="18" height="18"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('subscript')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
  </tr>
</table>
<IFRAME WIDTH=500 HEIGHT=200 ID=myEditor0></IFRAME>
<br>
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
<input type="hidden" name="hidden1" value="<?php if (isset($_POST['c0'])) { echo $_POST['c0']; }?>">
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
    <td width="335">Submitted By: <input type="text" name="author" size="20" value="<?php if (isset($_POST['c7'])) {echo $_POST['c7'];}?>"></td>
  </tr>
</table>
Explanation: <br>
<textarea rows="5" name="expl" cols="60"><?php if (isset($_POST['c8'])) { echo $_POST['c8']; }?></textarea><br>
<INPUT TYPE="button" VALUE="Submit" onClick="return doSubmit()"> </p>
</p>
</FORM>
</body>
</html>
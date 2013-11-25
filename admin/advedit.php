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
<html>
<head>
<title>Adv Editor</title>
<script language="JavaScript">
function Start() {
// For making the design mode of the iframe to ON state.
  document.getElementById('myEditor0').contentWindow.document.designMode = "on";
}
// Changing the colors of the buttons according to the mouse action
function selOn(ctrl) {
   ctrl.style.backgroundColor = '#B5BED6';
}
function selOff(ctrl) {
   ctrl.style.backgroundColor = '#D4D0C8';
}
function doAction(act) {
// Command for making text bold,italic and so on...
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
function htmToCode() {
// It will convert the iframe content to HTML code
   document.my.code.value=document.getElementById('myEditor0').contentWindow.document.body.innerHTML;
}
function CodeTohtm() {
// It will convert the textarea contents to HTML formatted page view.
   document.getElementById('myEditor0').contentWindow.document.body.innerHTML=document.my.code.value;
}
</script>
</head>
<body onload="Start()">
<FORM name=my>
<table border="0" cellpadding="0" cellspacing="0" width="533">
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
    <td align="center" bgcolor="#D4D0C8" width="18" ><img border="0" src="../images/sup.gif" width="18" height="18"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('superscript')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
    <td align="center" bgcolor="#D4D0C8" width="18" ><img border="0" src="../images/sub.gif" width="18" height="18"
    onMouseOver="selOn(this)" onMouseOut="selOff(this)"	onClick="doAction('subscript')"
    onMouseDown="selDown(this)" onMouseUp="selUp(this)"></td>
	<td width="31"></td>
	<td width="105"><input type="button" onClick="htmToCode()" value="Create Code"></td>
	<td width="111"><input type="button" onClick="CodeTohtm()" value="Create HTML"></td>
  </tr>
</table>
  
 <IFRAME WIDTH=600 HEIGHT=200 ID=myEditor0></IFRAME>
<br>
Code view <br>
<textarea rows="10" name="code" cols="73"></textarea><br>
</FORM>
</body>
</html>
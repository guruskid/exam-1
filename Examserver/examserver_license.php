<?php

session_start();
/****

 Copyright (C) <2008> <Shankar Palaniappan>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

For details or issues with program
Please contact shankar_p@users.sourceforge.net
               shankar.palaniappan@gmail.com

****/

class License
{
  function License()
  {
    if (!isset($_SESSION['exam_server_user_name']))
    {
  //    header("Location:http://localhost/Examserver/index.php");
    }
  }
  function displayLicense()
  {
    echo 
    "<table align=center><tr><td>
    <h5>Examserver version 1.0, 
    Copyright (C) 2008 Shankar Palaniappan</h5></td></tr><tr><td> 
    <h5>&#x0020;Examserver comes with ABSOLUTELY NO WARRANTY</h5></td></tr>
    <tr><td>
    <a href=\"\" 
    class=\"second\" 
    onClick=\"examRef = window.open('examserver_licenseInfo.php','GPL LICENSE',
    'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
     examRef.focus()\">
     To know More detail about GPL License</a>
     </tr></td></table>";
  }
}

// Main starts here

$license = new License;
$license->displayLicense();

// Main ends here
?> 

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
require_once("examserver_global.php");

class Instruction
{ 
  var $hostname;
  function Instruction($name)
  {
    $this->hostname=$name;
    $header_message = sprintf("Location:http://%s/Examserver/index.php",
         mysql_real_escape_string($this->hostname));
    if (!isset($_SESSION['exam_server_user_name']))
    {
      header($header_message);
    }
  }

  function displayTest()
  {
    echo "<html><head><title>Examserver Instruction</title></head><body background=\"img/bkgnd.jpg\"><table>";
    echo "<tr><td>1.The results will be displayed at the end of exam.</td></tr>";
    echo "<tr><td>2.The user will be allowed one minute to select correct choice. </td></tr></table>";
    echo "<tr><td>3.The author has no warranty for any problem with examserver.</td></tr></table>";
    echo "</body></html>";
  }
}

// Main starts here

$instruction = new Instruction($examserver_hostname);
$instruction->displayTest();

// Main ends Here
?>


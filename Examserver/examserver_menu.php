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

class Menu  
{
  var $username;
  var $hostname;

  function Menu($name)
  {
    $this->hostname=$name;
    if (!isset($_SESSION['exam_server_user_name']))
    {
      $header_message = sprintf("Location:http://%s/Examserver/index.php",
             mysql_real_escape_string($this->hostname));
      header($header_message);
    }
    $this->username=$_SESSION['exam_server_user_name'];
  }

  function displayMenu()
  {
  //  $logout=sprintf("<a href=http://%s/Examserver target =\"_top\">Log out</a>",
  //    mysql_real_escape_string($this->hostname)); 
    $logout=sprintf("<a href=http://$this->hostname/Examserver target =\"_top\">Log out</a>",
      mysql_real_escape_string($this->hostname)); 
    echo "<html><head>";
    echo "<base target=\"content\"> </head>";
    echo "<body background=\"img/bkgnd.jpg\">"; 
    echo "Welcome $this->username<HR>";
    echo "
    <a href=\"examserver_instructions.php\">Rules to attend the Examserver </a>
    <hr>
    <a href=\"examserver_changePassword.php\">Change Password </a>
    <hr>
    <a href=\"examserver_licenseInfo.php\">GPL LICENSE </a>
    <hr>
    <a href=\"examserver_retest.php\">Attend the Test </a>
    <hr>
    <a href=\"examserver_userMarks.php\">View the Marks</a>
    <hr>
    <a href=\"examserver_modelRetest.php\">Model Test</a>
    <hr>
    <a class=\"first\"  href=\"examserver_phpinfo.php\">PHP information</a>";
    if ($this->username == "admin")
    {
      echo "
      <hr>
      <a class=\"first\" href=\"examserver_userInsert.php\" >To add New User ! Register Here</a>";
    }
    echo "<hr>";
    echo $logout;
    echo"<hr>
    </body></html>
    ";
  }
}

// Main starts here

  $menu = new Menu($examserver_hostname);
  $menu->displayMenu();

// Main ends here

?>

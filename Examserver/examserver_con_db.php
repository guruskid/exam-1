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

class ConnectDB 
{ 
  var $hostname;

  function ConnectDB($name)
  { 
    $this->hostname=$name;

    if (!isset($_SESSION['exam_server_user_name']))
    {
   //   header("Location:http://localhost/Examserver/index.php");
    }
  }

  function selectDB()
  {
    // Connecting Examserver, selecting database
    $link = mysql_pconnect($this->hostname, 'admin', 'admin')
    or die('Could not connect:$this->hostname ' . mysql_error());
    //echo 'Connected successfully';
    mysql_select_db('examserv') or die('Could not select database');
  }

}
// Main starts here 

$connectDB = new ConnectDB($examserver_hostname); 

$connectDB->selectDB();

// Main ends here
?>


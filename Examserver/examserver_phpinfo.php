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

class PHPInformation
{
  var $hostname;
  function PHPInformation($name)
  {
    $this->hostname=$name;
    $header_message = sprintf("Location:http://%s/Examserver/index.php",
               mysql_real_escape_string($this->hostname));

    if (!isset($_SESSION['exam_server_user_name']))
    {
      header($header_message);
    }
  }

  function displayPhpInfo()
  { 
    // Show all information, defaults to INFO_ALL
    echo "<HR>";
    phpinfo();
    // Show just the module information.
    // phpinfo(8) yields identical results.
    phpinfo(INFO_MODULES);
    echo "<HR>";
  }
}

// Main starts here

$pHPInformation = new PHPInformation($examserver_hostname);
$pHPInformation->displayPhpInfo();

// Main ends here
?> 

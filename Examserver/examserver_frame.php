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

class Frame
{
  var $hostname;

  function Frame($name)
  {
    $this->hostname=$name;
    $header_message = sprintf("Location:http://%s/Examserver/index.php",
       mysql_real_escape_string($this->hostname));

    if (!isset($_SESSION['exam_server_user_name']))
    {
      header($header_message);
    }
  }

  function displayPage()
  {
    echo "
    <html><head></head>
    <frameset rows=\"10%,*\" BORDER=1>
    <frame name=\"title\" src=\"examserver_title.php\">
    <frameset cols=\"25%,75%,*\">
    <frame name=\"menu\" src=\"examserver_menu.php\">
    <frame name=\"content\" src=\"examserver_content.php\">
    </frameset>
    </html> ";
  }
}

// Main starts here

$frame = new Frame($examserver_hostname);
$frame->displayPage();

// Main Ends here
?>


<?php

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
class Install
{
  function installExamserver()
  {
    echo "<html><head><title>Installation of Examserver Database</title></head><body>";
    $output = exec('sh examserver_install.sh');
    echo "<pre>$output</pre>";
    echo "</body></html>";
  }
}

// Main starts here

$install = new Install(); 
$install->installExamserver();

// Main ends here
?> 


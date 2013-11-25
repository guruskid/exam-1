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

class Usermarks
{
  var $username; 
  var $extract_username; 
  var $computer_networks;
  var $ims;
  var $java;
  var $ss7;
  var $user_name;
  function UserMarks($name)
  {
    $this->hostname=$name;
    $this->username=$_SESSION['exam_server_user_name'];
    $this->extract_username=$_POST['select_user']; 
    if ( $this->extract_username)
    {
      $this->user_name= $this->extract_username; 
    }
    else
    {
      $this->user_name=$this->username;
    }
  }

  function displayMarks()
  {
    echo "<html>";
    echo "<head><title> Welcome to Examserver Home page</title></head>
    <body background=\"img/bkgnd.jpg\">
    <center>
    <BR><BR><BR>
    <table border=1 bgcolor=grey>
    <tr><th>User Name</th><th>Computer Networks</th><th>SS7</th>
    <th>Java</th><th>IMS</th></tr>
    <tr><td>$this->user_name</td>
    <td>$this->computer_networks</td><td>$this->ss7</td>
    <td>$this->java</td><td>$this->ims</td></tr>
    </table>
    </center>";
  }

  function connectDB()
  {
    require_once("examserver_con_db.php"); 
  }


  function extractMarks()
  {
    $this->connectDB();

    // Performing SQL query 
    // Only If UserName is not NULL 
    if ($this->user_name)
    { 
      $query = "SELECT computer_networks,ims,java,ss7 FROM user_marks where name='$this->user_name'";
      $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      $num_rows = mysql_num_rows($result);
      // echo $num_rows; 

      // If User is  present, extract the marks 
      if ($num_rows == 1)
      {
         while ($line = mysql_fetch_assoc($result))
         {
           $this->computer_networks=$line['computer_networks'];
           if ($this->computer_networks == -1)
           {         
             $this->computer_networks = "Not attended";
           }
           $this->ims=$line['ims'];
           if ($this->ims == -1)
           {         
             $this->ims = "Not attended";
           }
           $this->java=$line['java'];
           if ($this->java == -1)
           {         
             $this->java = "Not attended";
           }
           $this->ss7=$line['ss7'];
           if ($this->ss7 == -1)
           {         
             $this->ss7 = "Not attended";
           }
          }
      }
      // else Display the user not present
      //  Added Just to identify the Problem 
      else
      {
	echo "UserName Not exist, Problem with Examserver\n";
      }
    }

  } // extractMarks()

  // Feature restricted only for admin

  function extractAllUserMarks()
  {
     echo "<table align=center border =2><tr></tr><tr></tr><tr><td><form name=\"form1\" method=post action="; 
      ?>
      <?php echo $_SERVER['PHP_SELF']; ?>
      <?php
     echo ">";
    
    // Perform SQL query 
    // Only If UserName is admin 

    if ($this->username == "admin")
    { 
      $query = "select name from user_validation";
      $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      $num_rows = mysql_num_rows($result);
      //echo $num_rows; 

      // If User is  present, extract the marks 
      if ($num_rows)
      {
         echo "<select NAME=\"select_user\">";
         while ($line = mysql_fetch_assoc($result))
         {
              echo "<option VALUE="; 
              echo $line['name'];
              echo ">";
              echo $line['name'];
         } 
          echo "</select>"; 
         echo "<input type=submit value=\"View Other User Marks\">";
         echo "</form>";
         echo "</td></tr></table> </body> </html>";
       }

     }

  } // extractAllUserMarks()

}  // class UserMarks

// Main Starts here

$userMarks = new UserMarks($examserver_hostname);
$userMarks->extractMarks();
$userMarks->displayMarks();
$userMarks->extractAllUserMarks();

// Main Ends here

?> 

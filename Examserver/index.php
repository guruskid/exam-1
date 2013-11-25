<?php

session_unset(void);
unset($_SESSION['exam_server_user_name']);
session_destroy();
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

class Index
{
  var $username;
  var $password;
  var $boolean;

  function Index()
  {

    // Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
    if (!isset($_SESSION['count'])) {
      $_SESSION['count'] = 0;
    } else {
      $_SESSION['count']++;
    }

    $this->username=$_POST['username'];
    $this->password=$_POST['password'];
    $this->boolean=1;
    $_SESSION['exam_server_user_name']=$this->username;
  }

  function checkUserPassword()
  { 
    if ($this->username && $this->password)
    {
      require_once("examserver_con_db.php");
      // Performing SQL query
      $query = sprintf("SELECT name,passwd FROM user_validation where name='%s'",
        mysql_real_escape_string($this->username));

      $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      $num_rows = mysql_num_rows($result);
      if ($num_rows == 1)
      {
        $pwd="";
        while ($line = mysql_fetch_assoc($result))
        {
          $pwd= $line['passwd'];
        }
          if (crypt(trim($this->password), $pwd) == $pwd) 
        {
           $_SESSION['exam_server_user_name']=$this->username;
           require_once("examserver_frame.php");
           $this->boolean = 0; 
        }
        else
        {
           $this->boolean = 2; 
        }
        
      }
      else
      {
        $this->boolean = 3; 
      }
    }
//echo  $this->boolean;
  } // checkUserPassword()

  function displayLoginPage()
  {
    if ($this->boolean)
    {
      echo"<html>
      <head>";
      require_once("examserver_css.php");
      echo "</head>
      <title> Welcome to Examserver Home page</title></head> 
      <body background=\"img/bkgnd.jpg\" >
      <center>";
      echo "<HR>";
      echo "<H2>WELCOME TO EXAMSERVER LOGIN PAGE</H2>";
      echo "<HR>";
      echo "<H4>Sign in to Examserver!</H4>";
      echo"
      <table>
      <tr><td>
      <table border=1 bgcolor=\"grey\" align=\"center\">
      <form  method=post action=";
      echo $_SERVER['PHP_SELF'];
      echo ">
      <tr><td>Exam Server ID: </td><td><input type = text name=\"username\" maxlength=10 size=11></td></tr>
      <tr><td>Password      :</td><td><input type = password name=\"password\" maxlength=10 size=11></td></tr>
      <tr ><th ></th><th rowspan =2 >
      <input type = submit value=\"Login\">
      <input type = reset value=\"Clear\">
      </th></tr>
      </form>
      </table></td></tr>
      <tr><td>
      <table align=left>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr><td>";

      if ($this->boolean == 2)
      {
        echo "Password verification failed ! Please try again";
      }

      else if ($this->boolean == 3)
      {
        echo "Username and Password is not correct ! Please try again";
      }

      echo"
      </td></tr>
      <tr>
      <td>
      </td></tr>
      <tr></tr>
      <tr></tr>
      </table>
      <tr><td>
      </td></tr>
      <tr><td>
      </td></tr>
      <tr><td>
      </td></tr>
      <tr><td>
      </td></tr>
      <tr><td>
      ";
      require_once("examserver_license.php");
      echo "</td></tr></table>";
      echo "</center></body>
      </html>
      ";
    }

  } // function displayLoginPage()

} // class Index

// Main starts here

$index = new Index;
$index->checkUserPassword();
$index->displayLoginPage();

// Main Ends here

?>


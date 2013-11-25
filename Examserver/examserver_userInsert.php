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

class  UserInsert
{
  var $exam_username; 
  var $password;
  var $hostname;

  function UserInsert($name)
  {
    $this->hostname=$name;
    $header_message = sprintf("Location:http://%s/Examserver/index.php",
    mysql_real_escape_string($this->hostname));

    if (!isset($_SESSION['exam_server_user_name']))
    {
      header($header_message);
    }
    else
    {
      $this->exam_username=$_SESSION['exam_server_user_name'];
    }

  }

  function displayUserInsert()
  {
    echo "<html>";
    echo "<head><title> Welcome to Examserver Home page</title></head>
    <body background=\"img/bkgnd.jpg\">
    <center>
    <BR><BR><BR>
    New User register Here!
    <table border=1 bgcolor=grey>";
    echo "<form  method=post action=";
    echo $_SERVER['PHP_SELF'];
    echo ">
    <tr><td>Examserver ID:</td><td><input type = text name=\"username\" maxlength=10 size=11></td></tr>
    <tr><td>Password :</td><td><input type = password name=\"password\" maxlength=10 size=11></td></tr>
    <tr><th colspan=2><input type=submit value=Register></th></tr>
    </form>
    </table>
    </center>
    </body>
    </html>";
  }

  function connectDB()
  {
    require_once("examserver_con_db.php"); 
  }


  function userInsertLogic()
  {
    $_SESSION['exam_server_user_name']=$this->exam_username;
    $this->username=$_POST['username']; 
    $this->password=$_POST['password'];
    $this->connectDB();
    /***
     Check for the Presence of user
     If user not exist
       Insert the User 
     else 
       Display the User already exist
    ***/
    // Performing SQL query 
    // Only If UserName and Password Is not NULL 
    if ($this->username && $this->password)
    { 
      $query = "SELECT * FROM user_validation where name='$this->username'";
      $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      $num_rows = mysql_num_rows($result);
      // echo $num_rows; 

      // If User is not present, then add the User
      if ($num_rows == 0)
      {
         $password_mod = crypt(trim($this->password)); // let the salt be automatically generated
        //echo "$password_mod<hr>";
      	$query = "insert into user_validation values ('$this->username', '$password_mod')";
      	$user_query = "insert into user_marks (name)values ('$this->username')";
	//	echo $query;
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$num_rows = mysql_num_rows($result);
	$result = mysql_query($user_query) or die('Query failed: ' . mysql_error());
	echo "User Inserted Successfully\n";
        $login = sprintf("<a href=http://%s/Examserver target =\"_top\">Click here to Log in</a>", 
                  mysql_real_escape_string($this->hostname));
        echo $login;
      }
      // else Display the user already exist
      else
      {
	echo "UserName already exists, Please try again\n";
      }
    }

  } // userInsertLogic()

} // class UserInsert

// Main Starts here

$userInsert = new UserInsert($examserver_hostname);
$userInsert->displayUserInsert();
$userInsert->userInsertLogic();

// Main Ends here

?> 

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

class ChangePassword
{
  var $username; 
  var $old_password;
  var $new_password;
  var $new_password1;
  var $hostname;

  function ChangePassword($name)
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
      $this->username=$_SESSION['exam_server_user_name'];
    }   
  }

  function displayMenu()
  {
    echo "<html>";
    echo "<head><title>Examserver Password page</title></head>
    <body background=\"img/bkgnd.jpg\">
    <center>
    <BR><BR><BR>
    Change Password Here!
    <table border=1 bgcolor=grey>";
    echo "<form  method=post action=";
    echo $_SERVER['PHP_SELF'];
    echo ">
    <tr><td>Examserver ID:</td><td><input type = text name=\"username\"  
         value=\"$this->username\""; 
         if ($this->username != "admin") 
         echo "onFocus=\"this.blur()\" ";
         echo "maxlength=10 size=11></td></tr>
    <tr><td>Old Password :</td><td><input type = password name=\"old_password\" maxlength=10 size=11></td></tr>
    <tr><td>New Password :</td><td><input type = password name=\"new_password\" maxlength=10 size=11></td></tr>
    <tr><td>Confirm New Password :</td><td><input type = password name=\"new_password1\" maxlength=10 size=11></td></tr>
    <tr><th colspan=2><input type=submit value=\"Change Password\"></th></tr>
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
  
  function changePasswordLogic()
  {
    $this->connectDB();
    $this->username=$_POST['username']; 
    $this->old_password = $_POST['old_password'];
    $this->new_password = $_POST['new_password'];
    $this->new_password1 = $_POST['new_password1'];
  
    /***
     Check for the Presence of user
     If user not exist
       Insert the User 
     else 
       Display the User already exist
    ***/
    // Performing SQL query 
  
    /** 
      Only If UserName is not NULL 
      Old Password is not NULL 
      New Password is not NULL 
      Confirm NeW Password Is not NULL 
    **/
    if (( $this->new_password && $this->new_password1) 
           && ($this->new_password != $this->new_password1))
    {
      echo "New Pasword is not correct !";
    }
    else if ($this->username && $this->old_password 
            && $this->new_password && $this->new_password1)
    { 
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
          if (crypt(trim($this->old_password), $pwd) == $pwd)
          {
             $_SESSION['exam_server_user_name']=$this->username;
             $password_mod = crypt(trim($this->new_password)); // let the salt be automatically generated
             //echo "$password_mod<hr>";
             $query = sprintf("update user_validation set passwd='$password_mod' where name='%s'",
             mysql_real_escape_string($this->username));
             $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      	     $num_rows = mysql_num_rows($result);
  	     echo "Password updated Successfully for $this->username\n";
             $log_in=sprintf("<a href=http://%s/Examserver target =\"_top\">Click here to Log in</a>",
		mysql_real_escape_string($this->hostname));;
             echo $log_in;
             $boolean=0;
          }
          else
          {
           echo "Old Password is not correct !";
          }
  
      }
      // else Display the user Not exist
      else
      {
    	echo "UserName Not exists, Problem report the Bug\n";
      }

    } // end of New Password is correct  

  } // changePasswordLogic()

} // class ChangePassword


// Main starts Here

$changePassword = new ChangePassword($examserver_hostname);
$changePassword->displayMenu();
$changePassword->changePasswordLogic();

// Main Ends Here

?> 
